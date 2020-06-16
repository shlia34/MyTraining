<template>
    <div>
        <workoutForm
                :exercises="this.exercises"
                :muscle_code="this_program.muscle_code"
                :pid="pid"
                @clickBtn="addWorkout"
        ></workoutForm>

        <div class = "workouts-index  pb-4">
            <program
                    :clickable="true"
                    :program="this_program"
            ></program>
            <div>
                <a :href="'/programs/' + pid + '/destroy'"><i class="fas fa-trash ml-2"></i></a>
<!--                <div class="float-right"><a  href={{url()->previous()}}><button>戻る</button></a></div>-->
            </div>

            <program
                    :clickable="false"
                    :program="previous_program"
            ></program>
        </div>

        <div data-remodal-id="true-workout-remodal" data-remodal-options="hashTracking:false">
            <button class="remodal-close" data-remodal-action="close"></button>
            <button class="remodal-btn off-max-workout-btn">マックスをオフ</button>
        </div>

        <div data-remodal-id="false-workout-remodal" data-remodal-options="hashTracking:false">
            <button class="remodal-close" data-remodal-action="close"></button>
            <button class="remodal-btn on-max-workout-btn">マックスに登録</button>
            <button class="remodal-btn delete-workout-btn">削除</button>
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
                exercises:[],
                this_program:[],
                previous_program:[],
            }
        },
        created:function(){
            this.fetchData();
        },
        methods: {
            addWorkout: function(){
                this.fetchData();
            },
            fetchData(){
                var vm = this;
                const response = axios.post('/api/programs/show', {'programId':this.pid})
                    .then(function (response) {

                        vm.exercises = response.data.exercises;
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

</style>