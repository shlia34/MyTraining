<template>
    <div>
            <v-tabs
                    align-with-title
                    background-color="black"
                    dark
                    fixed-tabs
                    class="muscle-tabs"
            >
                <v-tabs-slider color="#F43E43"></v-tabs-slider>

                <v-tab
                        :key="muscle.code"
                        @click="selected_muscle_code = muscle.code"
                        fixed-tabs
                        class="muscle-tab"
                        v-for="muscle in muscles">
                    {{muscle.short_name}}
                </v-tab>
            </v-tabs>


        <div class ="muscle-group">
            <h4>{{selected_muscle_name}}</h4>

            <h5>やる種目リスト</h5>
            <div class ="draggable-box">
                <draggable @add="storeRoutine" @end="sortRoutine"  @remove="destroyRoutine" group="exercises" v-model="routines">
                    <div :data-exercise_id="exercise.id" :key="exercise.id" class="exercise-in-list" v-for="exercise in routines" >
                        <span>{{ exercise.name }}</span>

                        <router-link :to="'/exercises/' + exercise.id">
                            <v-btn icon>
                                <v-icon>mdi-redo</v-icon>
                            </v-btn>

                        </router-link>

                    </div>
                </draggable>
            </div>

            <h5>追加してないの種目リスト</h5>
            <div class ="draggable-box">
                <draggable group="exercises" v-model="notRoutines">
                    <div :data-exercise_id="exercise.id" :key="exercise.id" class="exercise-in-list" v-for="exercise in notRoutines">
                        <span>{{ exercise.name }}</span>

                        <router-link :to="'/exercises/' + exercise.id">
                            <v-btn icon>
                                <v-icon>mdi-redo</v-icon>
                            </v-btn>

                        </router-link>

                    </div>
                </draggable>
            </div>

        </div>

        <v-btn @click="showForm = true" icon v-if="!showForm">
            <v-icon>mdi-plus-circle-outline</v-icon>
        </v-btn>

        <v-btn @click="showForm = false" icon v-if="showForm">
            <v-icon>mdi-minus-circle-outline</v-icon>
        </v-btn>

        <v-form v-if="showForm" v-model="valid">
            <v-text-field
                    :rules="nameRules"
                    label="新しい種目"
                    required
                    v-model="formName"
            ></v-text-field>
            <Btn :color="'#454545'" :isDisabled="!valid" :text="'追加'" @clickBtn="storeExercise"></Btn>
        </v-form>



    </div>

</template>

<script>
    import draggable from 'vuedraggable'
    import Btn from '../components/Button'
    import {alertError} from '../alert'
    import {muscleNames} from '../const';

    export default {
        mixins:[alertError],
        components: {
            draggable,
            Btn,
        },
        props: {
            muscle_code:String,
        },
        data: function () {
            return {
                muscles:muscleNames,
                selected_muscle_code:this.muscle_code,
                routines:[],
                notRoutines:[],
                formName:"",
                showForm:false,
                valid:false,
                nameRules: [
                    v => !!v || 'なんかは入れろ',
                    v => !/^\s/.test(v) || '先頭空白はだめ',
                ],
            }
        },
        computed:{
            selected_muscle_name:function(){
                var code = this.selected_muscle_code;
                var selected_muscle = this.muscles.filter(function(muscle){
                    if(muscle.code === code){
                        return muscle;
                    }
                });

                return selected_muscle[0].name;
            },
        },
        watch:{
            selected_muscle_code:function(){
                this.fetchData();
                this.$router.push("/exercises/index/" + this.selected_muscle_code)
            }
        },
        created: function () {
            this.fetchData();
        },
        methods:{
            fetchData:function(){
                this.getRoutine();
                this.getNotRoutine();
            },
            getRoutine(){
                var vm =  this;
                const response = axios.get('/api/exercises/routines/' + vm.selected_muscle_code)
                    .then(function (response) {
                        vm.routines = response.data;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            getNotRoutine(){
                var vm =  this;
                const response = axios.get('/api/exercises/not_routines/' + vm.selected_muscle_code)
                    .then(function (response) {
                        vm.notRoutines = response.data;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            sortRoutine(){
                var vm =  this;

                var exercise_ids = [];
                this.routines.forEach(exercise => exercise_ids.push(exercise.id));

                const response = axios.patch('/api/routines/sort',{'exercise_ids':exercise_ids})
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
            storeRoutine(event){
                var vm =  this;
                var exercise_id = event.item.dataset.exercise_id;

                const response = axios.post('/api/routines',{'exercise_id':exercise_id})
                    .then(function (response) {
                        vm.sortRoutine();
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            destroyRoutine(event) {
                var vm =  this;
                var exercise_id = event.item.dataset.exercise_id;

                const response = axios.delete('/api/routines/' + exercise_id)
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            storeExercise(){
                var vm =  this;

                var data = {
                    'name':vm.formName,
                    'muscle_code':vm.selected_muscle_code
                };

                const response = axios.post('/api/exercises',data)
                    .then(function (response) {
                        vm.fetchData();
                        vm.formName = "";
                        vm.showForm = false;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
        },
    }
</script>

<style>

    .draggable-box{
        min-height: 44px;
    }

    .exercise-in-list{
        margin: 5px;
        padding: 5px;
        background-color: #454545;
    }

    .exercise-in-list span{
        color:white;
    }
    .exercise-in-list a{
        color:white;
        float: right;
    }

    .sortable-chosen {
        background-color: #c8c8c8;
    }


    .muscle-tabs{
        position: -webkit-sticky;
        position: sticky;
        top: 56px;
        z-index:11;
        background-color: white;
    }

    .v-tab {
        margin: 0px!important;
        min-width:0px!important;
    }

</style>