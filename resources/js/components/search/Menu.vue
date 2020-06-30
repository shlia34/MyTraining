<template>

    <v-col>
    </v-col>

</template>

<script>
    import {muscleOptions} from '../../const'

    export default {
        data () {
            return {
                muscleRadio: muscleOptions,
                form:{
                },

            }
        },
        watch:{
            form :{
                handler: function(){
                    this.pushRouter();
                },
                deep: true
            }
        },
        methods:{
            pushRouter(){
                this.$router.push({ path: '/search/menu' , query: this.form });
            },
        },
        created :function(){
        },
    }
</script>