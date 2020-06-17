<template>
    <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
        <span class = "mb-0">
            <a :href="'/exercises/' + menu.exercise_id" class = "card-title">{{ menu.name }}</a>
        </span>
        <ol :data-menu_id = menu.id class = "ol-workout mb-0">
            <li
                :class = "{ add_underline: workout.is_max }"
                :key="workout.id"
                @click="showModal(workout)"
                class = "workout"
                v-for="workout in menu.workouts">
                {{workout.weight }}kg * {{workout.rep}}rep
            </li>
        </ol>
    </div>
</template>

<script>

    export default {
        props:{
            menu: {
                type: Object,
                required: true
            },
            clickable: {
                type: Boolean,
                required: true
            },
        },
        data: function(){
            return{

            }
        },
        methods:{
            showModal: function(workout){
                if(!this.clickable){
                    return null;
                }

                var data = {
                    "program_id" :this.menu.program_id,
                    "menu_id" :this.menu.id,
                    "workout_id" :workout.id,
                    "is_max" :workout.is_max,
                };

                this.$emit('showModal', data);
            },
        },
    }

</script>

<style>
    .ol-workout {
        counter-reset: my-counter;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .ol-workout li {
        line-height: 1.5;
        padding-left: 30px;
        position: relative;
    }


    .workout {
        width: 45%;
        float: left;
        margin: 2px 2px 2px 6px;
    }

    .workout:before  {
        content: counter(my-counter);
        counter-increment: my-counter;
        font-size: 16px;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 22px;
        width: 22px;
        color: white;
        font-size: 70%;
        line-height: 1;
        position: absolute;
        top: 3.5px;
        left: 0px;
    }

    .add_underline {
        text-decoration: underline;
    }


</style>