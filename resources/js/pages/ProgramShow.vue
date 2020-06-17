<template>
    <div>
        <workoutForm
                :muscle_code="this_program.muscle_code"
                :pid="pid"
                @clickBtn="fetchData"
        ></workoutForm>

        <div class = "workouts-index  pb-4">
            <program
                    @showModal="showModal"
                    :clickable="true"
                    :program="this_program"
            >
            </program>
            <div>
                <i @click="destroyProgram" class="fas fa-trash ml-2"></i>
                <button class="float-right" onclick="history.back()">戻る</button>
            </div>

            <program
                    :clickable="false"
                    :program="previous_program"
            ></program>
        </div>

        <div v-if="isMaxModalActive">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container">
                            <div class="modal-header">
                                <slot name="header">
                                    <span @click="hideModal">×</span>
                                </slot>
                            </div>
                            <button @click="offMaxWorkout" class="remodal-btn off-max-workout-btn">マックスをオフ</button>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <div v-if="isNotMaxModalActive">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container">
                            <div class="modal-header">
                                <slot name="header">
                                    <span @click="hideModal">×</span>
                                </slot>
                            </div>
                            <div class="modal-footer">
                                <slot name="footer">
                                    <button @click="onMaxWorkout" class="remodal-btn on-max-workout-btn">マックスに登録</button>
                                    <button @click="deleteWorkout" class="remodal-btn delete-workout-btn">削除</button>
                                </slot>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

        </div>

    </div>
</template>


<script>
    import program from '../components/Program.vue';
    import workoutForm from '../components/WorkoutForm.vue';


    export default {
        components: {
            program,
            workoutForm,
        },
        props:{
            pid: String,
            required: true
        },
        data: function(){
            return {
                this_program:[],
                previous_program:[],
                modal_data:[],
                isMaxModalActive:false,
                isNotMaxModalActive:false,
            }
        },
        created:function(){
            this.fetchData();
        },
        methods: {
            deleteWorkout(){
                this.aboutWorkoutModal('/api/workouts/destroy');
            },
            onMaxWorkout(){
                this.aboutWorkoutModal('/api/workouts/max/on');
            },
            offMaxWorkout(){
                this.aboutWorkoutModal('/api/workouts/max/off')
            },
            aboutWorkoutModal(url){
                var vm =  this;

                const response = axios.post(url, vm.modal_data)
                    .then(function (response) {
                        vm.hideModal();
                        vm.fetchData();
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            destroyProgram(){
                alert('本当に消しますか？？？');
                var vm = this;
                var data = { 'program_id':vm.pid };

                const response = axios.post('/api/programs/destroy', data)
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
                //todo vue routeでやる
            },
            showModal: function(data){
                this.modal_data = data;

                if(this.modal_data.is_max === 1){
                    this.isMaxModalActive = true;
                }else{
                    this.isNotMaxModalActive = true;
                }

            },
            hideModal(){
                this.isMaxModalActive = false;
                this.isNotMaxModalActive = false;
            },
            fetchData(){
                var vm = this;
                const response = axios.post('/api/programs/show', {'programId':vm.pid})
                    .then(function (response) {

                        vm.this_program = response.data.thisProgram;
                        vm.previous_program = response.data.previousProgram;

                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
        }
    }

</script>


<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }




    .fa-trash{
        color: #454545;
    }


    .on-max-workout-btn{
        background-color: #F43E43;
    }
    .off-max-workout-btn{
        background-color: #454545;
    }
    .delete-workout-btn{
        background-color: #c8c8c8;
    }


</style>