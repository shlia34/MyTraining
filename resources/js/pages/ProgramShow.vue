<template>
    <div>
        <workoutForm
                :muscle_code="this_program.muscle_code"
                :pid="pid"
                @clickBtn="getThisProgram"
        ></workoutForm>

        <div class = "workouts-index  pb-4">
            <program
                    @showModal="showModal"
                    :clickable="true"
                    :program="this_program"
            >
            </program>

            <div><i @click="destroyProgram" class="fas fa-trash ml-2"></i></div>

            <program
                    v-if="previous_program.length !== 0"
                    :clickable="false"
                    :program="previous_program"
            ></program>
        </div>

        <div v-if="isMaxModalActive">
            <Modal @hideModal="hideModal">
                <template v-slot:footer>
                    <Btn @clickBtn="offMaxWorkout" :isModal="true" :text="'マックスをオフ'" :color="'#454545'"></Btn>
                </template>
            </Modal>
        </div>

        <div v-if="isNotMaxModalActive">
            <Modal @hideModal="hideModal">
                <template v-slot:footer>
                    <Btn @clickBtn="onMaxWorkout" :isModal="true" :text="'マックスに登録'" :color="'#F43E43'"></Btn>
                    <Btn @clickBtn="deleteWorkout" :isModal="true" :text="'削除'" :color="'#c8c8c8'"></Btn>
                </template>
            </Modal>
        </div>

    </div>
</template>


<script>
    import program from '../components/Program.vue';
    import workoutForm from '../components/WorkoutForm.vue';
    import Btn from '../components/Button.vue'
    import Modal from '../components/Modal.vue'
    import {alertError} from '../alert'


    export default {
        mixins:[alertError],
        components: {
            program,
            workoutForm,
            Btn,
            Modal
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
        created: async function(){
            await this.getThisProgram();
            this.getPreviousProgram();
        },
        watch:{
            pid: async function(){
                await this.getThisProgram();
                this.getPreviousProgram();
            },
        },
        methods: {
            deleteWorkout(){
                var vm = this;

                const response = axios.delete('/api/workouts/' + vm.modal_data.workout_id)
                    .then(function (response) {
                        vm.hideModal();
                        vm.getThisProgram();
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
            onMaxWorkout(){
                this.aboutMax('/api/workouts/max/on');
            },
            offMaxWorkout(){
                this.aboutMax('/api/workouts/max/off')
            },
            aboutMax(url){
                var vm =  this;
                const response = axios.patch(url, vm.modal_data)
                    .then(function (response) {
                        vm.hideModal();
                        vm.getThisProgram();
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            destroyProgram(){
                alert('本当に消しますか？？？');
                var vm = this;

                const response = axios.delete('/api/programs/' + vm.pid)
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
                this.$router.push('/')
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
            async getThisProgram(){
                var vm = this;

                await axios.get('/api/programs/' + vm.pid)
                    .then(function (response) {
                        vm.this_program = response.data;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            getPreviousProgram(){
                var vm = this;
                axios.get('/api/programs/'+vm.this_program.date + '/' + vm.this_program.muscle_code)
                    .then(function (response) {
                        vm.previous_program = response.data;
                    }).catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
        }
    }

</script>


<style>
    .workouts-index{
        min-height: calc(100vh - 296.5px);
    }

    .fa-trash{
        color: #454545;
    }
</style>