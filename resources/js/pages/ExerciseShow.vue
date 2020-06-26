<template>
    <div>

        <Title :text="exercise.name"></Title>

        <Menu
            :clickable="false"
            :key="menu.id"
            :menu="menu"
            v-for="menu in menus.data">
        </Menu>
        <span v-if="menus.total === 0">まだこの種目やってません</span>

        <Paginate
            v-if="menus.total !== 0"
            :current_page="menus.current_page"
            :last_page="menus.last_page"
            @switchPage="switchPage"></Paginate>
    </div>

</template>


<script>
    import Menu from '../components/Menu.vue';
    import Title from '../components/Title'
    import Paginate from '../components/Paginate.vue';
    import {alertError} from '../alert'


    export default {
        mixins:[alertError],
        components:{Menu,Paginate,Title },
        props:{
            exercise_id:String,
            default_page:{
                type:Number,
                default: 1,
            },

        },
        data: function(){
            return{
                exercise:null,
                menus:null,
                page:this.default_page,
            }
        },
        created:function(){
            this.fetchData();
        },
        methods:{
            fetchData:function(){
                var vm =  this;

                const response = axios.get("/api/exercises/"+vm.exercise_id+ '?page=' + vm.page)
                    .then(function (response) {
                        vm.exercise = response.data.exercise;
                        vm.menus = response.data.menus;
                    }).catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
            switchPage(page){
                this.page = page;
                this.fetchData();
                this.$router.push("/exercises/" + this.exercise_id + "/?page=" + this.page)
            },
        },
    }
</script>

<style></style>

