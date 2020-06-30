<template>

    <v-col>
        <v-text-field
                label="name"
                v-model="form.name"
        ></v-text-field>
        <v-layout>
            <v-checkbox
                    :key="muscle.value"
                    :label="muscle.text"
                    :value="muscle.value"
                    v-for="muscle in muscleRadio"
                    v-model="form.muscle_code"></v-checkbox>
        </v-layout>
    </v-col>

</template>

<script>
    import {muscleOptions} from '../../const'

    export default {
        data () {
            if(this.$route.params.model === 'exercise'){
                var name =  this.$route.query.name;
                var muscle_code = this.$route.query.muscle_code instanceof Array ? this.$route.query.muscle_code :[this.$route.query.muscle_code];
            }
            return {
                muscleRadio: muscleOptions,
                form:{
                    name:name ?? null,
                    muscle_code:muscle_code ?? [],
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
                this.$router.push({ path: '/search/exercise' , query: this.form });
            },
        },
        created :function(){
        },
    }
</script>