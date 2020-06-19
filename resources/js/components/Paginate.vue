<template>
    <div>
        <ul class="pagination mt-2 mb-2 mr-2 ml-2" role="navigation">
            <li
                :class="{active: page === selected_page}"
                aria-current="page"
                class="page-item"
                v-for="page in last_page">
                <span class="page-link" v-if="page === selected_page">{{page}}</span>
                <a @click="selected_page = page" class="page-link" href="#" v-else>{{ page }}</a>
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        props:{
            current_page: {
                type: Number,
                required: true
            },
            last_page: {
                type: Number,
                required: true
            },
        },
        data: function(){
            return{
                selected_page:this.current_page,
            }
        },
        watch:{
            selected_page:function(){
                this.$emit('switchPage',this.selected_page);
            }
        },
        methods:{
        },
    }

</script>

<style>
    .active .page-link {
        background-color: #454545!important;
    }


</style>