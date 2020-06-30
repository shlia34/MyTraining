<template>
    <v-container>

        <v-radio-group v-model="target">
            <v-layout>
                <v-radio
                        :key="model"
                        :label="model"
                        :value="model"
                        v-for="model in models"
                ></v-radio>
            </v-layout>
        </v-radio-group>

        <ProgramSearch ref="program" v-show="target === 'program'"></ProgramSearch>
        <MenuSearch ref="menu" v-show="target === 'menu'"></MenuSearch>
        <WorkoutSearch ref="workout" v-show="target === 'workout'"></WorkoutSearch>
        <ExerciseSearch ref="exercise" v-show="target === 'exercise'"></ExerciseSearch>



        <v-card>
            <v-data-table
                    :headers="target_headers"
                    :items="items"
                    dense
            ></v-data-table>
        </v-card>

    </v-container>

</template>

<script>
    import {alertError} from '../alert'

    import ProgramSearch from '../components/search/Program'
    import MenuSearch from '../components/search/Menu'
    import WorkoutSearch from '../components/search/Workout'
    import ExerciseSearch from '../components/search/Exercise'


    export default {
        mixins:[ alertError ],
        components:{ProgramSearch , MenuSearch, WorkoutSearch ,ExerciseSearch},
        props:{
            model: {
                type: String,
                required: true,
            },
        },
        data () {
            return {
                models:['program','menu','workout','exercise'],
                target:this.model,
                target_header:[],
                items:[],

                program: {
                    headers: [
                        { text: '日付', value: 'date' },
                        { text: '部位', value: 'muscle_name' },
                        { text: 'max種目', value: 'max_workout.exercise_name' },
                        { text: 'max重量', value: 'max_workout.weight' },
                        { text: 'maxレップ', value: 'max_workout.rep' },
                        { text: 'メモ', value: 'memo' },
                    ],
                },
                exercise: {
                    headers: [
                        { text: '名前', value: 'name' },
                        { text: '部位', value: 'muscle_name' },

                    ],
                },
                menu: {
                    headers: [
                        { text: '日付', value: 'date' },
                        { text: '部位', value: 'muscle_code' },
                        { text: '名前', value: 'name' },
                    ],
                },
                workout: {
                    headers: [
                        { text: '日付', value: 'date' },
                        { text: '部位', value: 'muscle_code' },
                        { text: '名前', value: 'name' },
                        { text: 'weight', value: 'weight' },
                        { text: 'rep', value: 'rep' },
                        { text: 'is_max', value: 'is_max' },
                    ],
                },

            }
        },
        watch:{
            $route (to, from) {
                this.getItems();
            },
            target:function(){
                switch (this.target) {
                    case 'program':
                        this.$refs.program.pushRouter();
                        break;
                    case 'menu':
                        this.$refs.menu.pushRouter();
                        break;
                    case 'workout':
                        this.$refs.workout.pushRouter();
                        break;
                    case 'exercise':
                        this.$refs.exercise.pushRouter();
                        break;
                }
                this.setTarget();

            },
        },
        methods:{
            getItems: function(){
                var vm = this;

                const response = axios.get('/api/search/' + vm.target, {params: this.$route.query})
                    .then(function (response) {
                        vm.items = response.data;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            setTarget: function(){
                switch (this.target) {
                    case 'program':
                        this.target_headers = this.program.headers;
                        break;
                    case 'menu':
                        this.target_headers = this.menu.headers;
                        break;
                    case 'workout':
                        this.target_headers = this.workout.headers;
                        break;
                    case 'exercise':
                        this.target_headers = this.exercise.headers;
                        break;
                    default:
                        this.target_headers = this.program.headers;
                }
            },
        },
        created :function(){
            this.setTarget();
            this.getItems();
        },
    }
</script>

<style></style>