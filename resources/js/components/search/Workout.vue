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
                label="name"
                v-model="form.name"
        ></v-text-field>

        <v-layout>
            <v-checkbox
                    :label="'maxで絞る'"
                    :value="true"
                    v-model="form.is_max"></v-checkbox>
        </v-layout>

    </v-col>

</template>

<script>
    import {muscleOptions} from '../../const'

    export default {
        data () {
            if(this.$route.params.model === 'workout') {
                var start = this.$route.query.start;
                var end = this.$route.query.end;
                var muscle_code = this.$route.query.muscle_code;
                var name = this.$route.query.name;
                var is_max = !!this.$route.query.is_max;
            }
            return {
                muscleRadio: muscleOptions,
                form:{
                    start:start ?? null,
                    end:end ?? null,
                    muscle_code:muscle_code ?? [],
                    name: name ?? null,
                    is_max:is_max ?? null,
                },
            }
        },
        watch:{
            form :{
                handler: function(){
                    this.pushRouter();
                    console.log("変更されたよ");
                },
                deep: true
            }
        },
        methods:{
            pushRouter(){
                this.$router.push({ path: '/search/workout' , query: this.form });
                console.log(this.form);
            },
        },
        created :function(){
        },
    }
</script>