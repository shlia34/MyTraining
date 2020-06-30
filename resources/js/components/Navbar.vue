<template>

    <v-card
            class="mx-auto top-nav"
            width="100%"
    >
        <v-app-bar
                color="#F43E43"
                dark
        >
            <router-link to="/">MyTraining</router-link>
            <v-spacer></v-spacer>

            <v-menu transition="slide-y-transition">
                <template v-slot:activator="{ on, attrs }">
                        <v-app-bar-nav-icon v-bind="attrs" v-on="on"></v-app-bar-nav-icon>
                </template>
                <v-list>
                    <v-list-item :key="item.text" link v-for="item in items">
                        <router-link :to=item.link class="top-navv-link" >{{item.text}}</router-link>
                    </v-list-item>
                    <v-list-item>
                        <a @click="logout">ログアウト</a>
                    </v-list-item>
                </v-list>
            </v-menu>

            <div class="mx-4 hidden-sm-and-down"></div>

        </v-app-bar>
    </v-card>

</template>


<script>

    import {alertError} from '../alert'

    export default {
        mixins:[alertError],
        data:function(){
            return {
                items: [
                    { text: '種目', link: '/exercises/index/01' },
                    { text: '検索', link: '/search/program' },
                    { text: 'csv', link: '/csv/index' },
                ],
            }
        },
        methods:{
            logout:function(){
                var vm = this;
                var response = axios.post('/logout').then(function (response) {
                    location.href = '/login';
                })
                .catch(function (error) {
                    vm.alertError(error.response);
                });
            },
        },
    }
</script>


<style>
    .top-nav{
        z-index:12;
        position: fixed;
        height:56px;
    }
    .top-nav a{
        color: white!important;
    }

</style>