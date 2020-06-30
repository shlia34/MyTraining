<template>
<v-container>

    <v-layout >
        <v-col>
            <a :href="'/csv/export/' + modelName" target="_blank"  v-for="modelName in modelNames">
                <Btn :color="'#454545'" :text="modelName + ' Export'"></Btn>
            </a>
        </v-col>
    </v-layout>

    <v-file-input accept=".csv" label="importするCSVファイルを指定" v-model="file"></v-file-input>
    <Btn :color="'#F43E43'" :text="'Import'" @clickBtn="importFile"></Btn>

</v-container>


</template>

<script>
    import Btn from '../components/Button'

    export default {
        components:{Btn},
        data:function(){
            return {
                modelNames: [],
                file:null,
            }
        },
        created:function(){
            this.fetchData();
        },
        methods: {
            fetchData:function(){
                var vm = this;
                var response = axios.get('/api/csv/index')
                    .then(function (response) {
                        vm.modelNames = response.data;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
            importFile(){
                const formData = new FormData();
                formData.append('csv', this.file);

                var vm =  this;
                var response = axios.post('/csv/import',formData,{
                    headers: {
                        'content-type': 'text/csv',
                    },
                })
                    .then(function (response) {
                        vm.file = null;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                    });
            },
        },

    }
</script>

<style></style>
