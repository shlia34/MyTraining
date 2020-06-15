<template>
    <div>
        <a :href="'/programs/' + item.id" >
            <div class = "program-title">{{item.date}}の{{item.muscle_name}}トレ</div>
        </a>

        <div :data-program_id =item.id class="program-show">
                <span class = "program-memo">{{item.memo}}</span>
                <div class = "workouts">
                    <Menu
                        :clickable="clickable"
                        :key="menu.id"
                        :menu="menu"
                        v-for="menu in item.menus"
                    ></Menu>
                </div>
            </div>
    </div>
</template>


<script>
    import Menu from './Menu.vue';

    export default {
        props:['item','text','clickable'],
        components:{
            Menu,
        },
        data: function(){
            return{

            }
        }
    }


</script>