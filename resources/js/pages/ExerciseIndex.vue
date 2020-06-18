<template>
    <div>
        <div>
            <a class="btn" href="/">ない場合は種目を追加</a>
            <backBtn></backBtn>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li :key="muscle.id"
                @click="selected_muscle_code =muscle.id"
                class="nav-item"
                v-for="muscle in muscles">
                <a :aria-controls=muscle.name
                   :class="{active: muscle_code===muscle.id}"
                   :href="'#' + muscle.name"
                   aria-selected="false"
                   class="nav-link"
                   data-toggle="tab"
                   role="tab">
                    {{muscle.short_name}}</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pan " role="tabpanel" >
                <div class ="muscle-group">
                    <h4>{{selected_muscle_name}}</h4>
                    <h5>やる種目リスト</h5>
                    <div class = "routines">
                        <div :key="exercise.id" class="exercise-in-list" v-for="exercise in routines">
                            <span>{{ exercise.name }}</span><a :href= "'/exercises/' + exercise.id "><i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>

                    <h5>追加してないの種目リスト</h5>
                    <div class = "not-routines">
                        <div :key="exercise.id" class="exercise-in-list" v-for="exercise in notRoutines">
                            <span>{{ exercise.name }}</span><a :href= "'/exercises/' + exercise.id "><i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {muscleNames} from '../const';
    import backBtn from '../components/BackBtn.vue';

    export default {
        components: {
            backBtn,
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
            }
        },
        computed:{
            selected_muscle_name:function(){
                var code = this.selected_muscle_code;
                var selected_muscle = this.muscles.filter(function(muscle, index){
                    if(muscle.id === code){
                        return muscle;
                    }
                });

                return selected_muscle[0].name;
            },
        },
        watch:{
            selected_muscle_code:function(){
                this.fetchData();
            }
        },
        created: function () {
            this.fetchData();
        },
        methods:{
            fetchData:function(){
                var vm =  this;
                const response = axios.post('/api/exercises/index',{'muscle_code':vm.selected_muscle_code})
                    .then(function (response) {
                        vm.routines = response.data.routines;
                        vm.notRoutines = response.data.notRoutines;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
        },
    }
</script>

<style>

    .routines{
        min-height: 44px;
    }
    .not-routines{
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
        /*margin-right: 20px;*/
        width: 30px;
    }

    .placeholder {
        background-color: #c8c8c8;
        height: 34px;
        margin: 5px;
    }
</style>