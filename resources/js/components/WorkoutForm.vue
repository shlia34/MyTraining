<template>
    <div class = "add-workout-form-box form-inline pt-3 pl-3 pr-3">

        <select class = 'form-exercise_id browser-default custom-select mb-2' v-model="selected_exercise_id">
            <option
                    v-for="exercise in exercises"
                    :value="exercise.id"
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
            <a :href ="'/exercises/index?muscleCode=' + muscle_code" v-if="this.exercises.length === 0">
                <Btn :text="'種目'"></Btn>
            </a>
            <Btn :color="'#454545'" :isDisabled="weightAndRepValidation" :text="'記録'" @clickBtn="storeWorkout" v-else></Btn>
        </div>

    </div>

</template>



<script>
    import Btn from './Button'
    import {alertError} from '../alert'

    export default {
        mixins:[alertError],
        components: {
            Btn,
        },
        props:{
            pid: String,
            muscle_code:String,
        },
        data: function(){
            return{
                program_id:this.pid,
                weight:"",
                rep:"",
                exercises:[],
                selected_exercise_id:"",
            }
        },
        watch:{
            muscle_code: function(){
                this.fetchData();
            },
        },
        computed:{
            weightAndRepValidation: function(){
                var weightValidationError = this.weight == "" || this.weight ==  0  || this.weight > 999.9 || (/^[0][0-9]/).test(this.weight)　|| /[/.][0-9]{2,}/.test(this.weight);
                // 整数部分は3桁以内、少数部分は1桁以内の数字を許可する
                // ①空か②0じゃないか③999.9より小さいか④0の後に数字がこないか⑤小数値が2個以上続かないか
                var repValidationError = this.rep == "" || /^0/.test(this.repl)　|| this.rep > 99 || /[/.]/.test(this.rep);
                //  少数を許さない整数2桁以内

               return  (weightValidationError == true || repValidationError == true);
            },
        },
        methods: {
            storeWorkout:function(){
                var vm = this;

                var data = {
                    'program_id':vm.program_id,
                    'exercise_id':vm.selected_exercise_id,
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
            fetchData(){
                var vm = this;
                var mc = vm.muscle_code;
                const response = axios.post('/api/exercises/index/routine', {'muscleCode':mc})
                    .then(function (response) {
                        vm.exercises = response.data.exercises;
                        vm.selected_exercise_id = response.data.exercises[0].id;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
        },
    }
</script>



<style>
    .forms{
        display: flex;
    }

    .form-weight {
        width:50px;
    }

    .add-workout-form-box{
        color: white;
        position: -webkit-sticky;
        position: sticky;
        top: 56px;
        z-index:11;
        background-color: white;
    }

</style>