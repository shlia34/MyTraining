<template>
    <div>
        <router-link :to="`/programs/${program.id}`">
            <Title :text="program.date +'の'+ program.muscle_name + 'トレ'"></Title>
        </router-link>

        <div class="program-show">
            <span class = "program-memo">{{program.memo}}</span>
            <div class = "workouts">
                <Menu
                    :clickable="clickable"
                    :key="menu.id"
                    :menu="menu"
                    @showModal="showModal"
                    v-for="menu in program.menus"
                ></Menu>
            </div>
        </div>
    </div>
</template>


<script>
    import Menu from './Menu.vue';
    import Title from './Title.vue'

    export default {
        props:{
            program: {
                required: true
            },
            clickable: {
                type: Boolean,
                required: true
            },
        },
        components:{
            Menu,Title
        },
        data: function(){
            return{
            }
        },
        methods:{
            showModal:function(data){
                this.$emit('showModal', data);
            },
        },

    }


</script>

<style>
    .program-memo{
        color: #454545;
    }
</style>