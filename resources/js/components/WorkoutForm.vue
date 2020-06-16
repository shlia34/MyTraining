<template>
    <div class = "add-exercise-form-box form-inline pt-3 pl-3 pr-3">

        <select class = 'form-exercise_id browser-default custom-select mb-2' v-model="exercise_id">
            <option
                    :key="exercise.id"
                    :value="exercise.id"
                    v-for="exercise in exercises"
            >{{ exercise.name }}</option>
        </select>


        <div class="forms">
            <div class="md-form m-0 ml-3 w-25">
                <input class="form-weight form-control" id="form-weight" type="number" v-model="weight">
                <label for="form-weight">weight</label>
            </div>

            <div class="md-form m-0 ml-3 w-25">
                <input class="form-rep form-control" id="form-rep" type="number" v-model="rep">
                <label for="form-rep">rep</label>
            </div>
            <a :href ="'/exercises/index?muscleCode=' + muscle_code" v-if="this.exercises.length === 0"><button class = "btn waves-effect w-30 ml-4" type="button">種目<i class="fas fa-cog"></i></button></a>
            <button @click="storeWorkout" class ="add-workout-btn btn waves-effect w-30 ml-4" type="button" v-else >記録</button>
        </div>

    </div>

</template>



<script>
    export default {
        props:['exercises','pid','muscle_code'],
        data: function(){
            return{
                program_id:this.pid,
                weight:null,
                rep:null,
            }
        },
        computed: {
            exercise_id: function () {
                var first =  this.exercises[0];

                if(first !== undefined){
                    return first.id;
                }
            }
        },
        methods: {
            storeWorkout:function(){
                var vm = this;

                var data = {
                    'program_id':vm.program_id,
                    'exercise_id':vm.exercise_id,
                    'weight':vm.weight,
                    'rep':vm.rep,
                };

                const response = axios.post('/api/workouts/store', data)
                    .then(function (response) {
                        vm.$emit('clickBtn',response.data);
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
        },
    }
</script>



<style>


</style>