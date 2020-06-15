<template>
    <div class = "add-exercise-form-box form-inline pt-3 pl-3 pr-3">
        <select class = 'form-exercise_id browser-default custom-select mb-2' v-model="form.exerciseId">
            <option
                    :key="exercise.id"
                    :value="exercise.id"
                    v-for="exercise in exercises"
            >{{ exercise.name }}</option>
        </select>


        <div class="forms">
            <div class="md-form m-0 ml-3 w-25">
                <input class="form-weight form-control" id="form-weight" type="number" v-model="form.weight">
                <label for="form-weight">weight</label>
            </div>

            <div class="md-form m-0 ml-3 w-25">
                <input class="form-rep form-control" id="form-rep" type="number" v-model="form.rep">
                <label for="form-rep">rep</label>
            </div>
            <a :href ="'/exercises/index?muscleCode=' + program.muscle_code" v-if="exercise_length === 0"><button class = "btn waves-effect w-30 ml-4" type="button">種目<i class="fas fa-cog"></i></button></a>
            <button @click="storeWorkout" class ="add-workout-btn btn waves-effect w-30 ml-4" type="button" v-else >記録</button>
        </div>
    </div>

</template>



<script>
    export default {
        props:['exercises','program'],
        data: function(){

            return{
                form:{
                    programId:this.program.id,
                    exerciseId:null,
                    weight:null,
                    rep:null,
                },
                exercise_length:this.exercises.length,
            }
        },
        methods: {
            storeWorkout:function(){
                console.log(this.form);
            },
        },
    }
</script>



<style>


</style>