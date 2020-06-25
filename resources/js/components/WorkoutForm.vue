<template>
    <div class = "add-workout-form-box form-inline pt-3 pl-3 pr-3">

        <select class = 'form-exercise_id browser-default custom-select mb-2' v-model="selected_exercise_id">
            <option
                    v-for="exercise in exercises"
                    :value="exercise.id"
            >{{ exercise.name }}</option>
        </select>

            <v-form v-model="valid">
                <v-container fluid>
                     <v-row>
                        <v-col>
                            <v-text-field
                                    v-model.number="weight"
                                    :rules="weightRules"
                                    label="weight"
                                    type="number"
                                    required
                            ></v-text-field>
                        </v-col>

                        <v-col>
                            <v-text-field
                                    v-model.number="rep"
                                    :rules="repRules"
                                    label="rep"
                                    type="number"
                                    required
                            ></v-text-field>
                        </v-col>

                        <v-col>
                            <router-link :to ="'/exercises/index/' + muscle_code" v-if="this.exercises.length === 0">
                                <Btn :color="'grey'" :text="'種目'"></Btn>
                            </router-link>

                            <Btn :color="'#454545'" :isDisabled="!valid" :text="'記録'" @clickBtn="storeWorkout" v-else></Btn>
                        </v-col>

                    </v-row>

                </v-container>

            </v-form>

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
            program_id: String,
            muscle_code:String,
        },
        data: function(){
            return{
                weight:"",
                rep:"",
                exercises:[],
                selected_exercise_id:"",

                valid: false,
                weightRules: [
                    v => !!v || 'なんかは入れろ',
                    v => v !== 0 || '0はだめ',
                    v => v < 999.9 || '整数部分は3桁以内',
                    v => !(/^[0][0-9]/).test(v) || '0の後に数字くんな',
                    v => !/[/.][0-9]{2,}/.test(v) || '小数点に2個以上続くな',
                ],
                repRules: [
                    v => !!v || 'なんかは入れろ',
                    v => !/^0/.test(v) || '先頭0はだめ',
                    v => v < 100 || '2桁以内の整数にしろ',
                    v => !/[/.]/.test(v) || '小数禁止',
                ],
            }
        },
        watch:{
            muscle_code: function(){
                this.getExercise();
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

                const response = axios.post('/api/workouts', data)
                    .then(function (response) {
                        vm.$emit('clickBtn');
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            getExercise(){
                var vm = this;
                const response = axios.get('/api/exercises/routines/' + vm.muscle_code )
                    .then(function (response) {
                        vm.exercises = response.data;
                        vm.selected_exercise_id = response.data[0].id;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
        },
    }
</script>



<style>
    .add-workout-form-box{
        color: white;
        position: -webkit-sticky;
        position: sticky;
        top: 56px;
        z-index:11;
        background-color: white;
    }

</style>