<template>

    <v-col>
        <v-layout>
            <v-text-field type="date" v-model="form.start"></v-text-field>
            <v-text-field type="date" v-model="form.end"></v-text-field>
        </v-layout>

        <v-layout>
            <v-checkbox
                    :key="muscle.value"
                    :label="muscle.text"
                    :value="muscle.value"
                    v-for="muscle in muscleRadio"
                    v-model="form.muscle_code"></v-checkbox>
        </v-layout>

        <v-text-field
                label="memo"
                v-model="form.memo"
        ></v-text-field>

    </v-col>

</template>


<script>
    import {muscleOptions} from '../../const'

    export default {
        data () {
            if(this.$route.params.model === 'program'){
                var start = this.$route.query.start;
                var end = this.$route.query.end;
                var muscle_code = this.$route.query.muscle_code;
                var memo = this.$route.query.memo;
            }
            return {
                muscleRadio: muscleOptions,
                form :{
                    start:start?? null,
                    end:end ?? null,
                    muscle_code:muscle_code ?? [],
                    memo:memo ?? null,
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
                this.$router.push({ path: '/search/program' , query: this.form });
            }
        },
        created :function(){

        },
    }
</script>

