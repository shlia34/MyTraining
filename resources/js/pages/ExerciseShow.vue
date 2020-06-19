<template>
    <div>
        <backBtn></backBtn>

        <div class = "program-title">{{ exercise.name }}</div>

        <Menu
            :clickable="false"
            :key="menu.id"
            :menu="menu"
            v-for="menu in menus.data">
        </Menu>
        <span v-if="menus.total === 0">まだこの種目やってません</span>

        <Paginate
            :current_page="menus.current_page"
            :last_page="menus.last_page"
            @switchPage="switchPage"></Paginate>
    </div>

</template>


<script>
    import backBtn from '../components/BackBtn.vue';
    import Menu from '../components/Menu.vue';
    import Paginate from '../components/Paginate.vue';

    export default {
        components:{backBtn,Menu,Paginate },
        props:{
            exercise_id:String,
            default_page:Number,
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
            },
        },
    }
</script>

<style></style>

