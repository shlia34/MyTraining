<template>
    <div>
        <a :href="'/programs/' + program.id" >
            <Title :text="program.date +'の'+ program.muscle_name + 'トレ'"></Title>
        </a>

        <div :data-program_id =program.id class="program-show">
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
            test(){
                console.log(this.program);
            }
        },

    }


</script>

<style>
    .program-memo{
        color: #454545;
    }
</style>