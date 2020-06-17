<template>
    <div>
        <a :href="'/programs/' + program.id" >
            <div class = "program-title">{{program.date}}の{{program.muscle_name}}トレ</div>
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
            Menu,
        },
        data: function(){
            return{
            }
        },
        methods:{
            showModal:function(data){
                this.$emit('showModal', data);
            }
        },

    }


</script>