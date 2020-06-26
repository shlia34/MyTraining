<template>

    <v-card
            width="100%"
            class="mx-auto top-nav"
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
                    <v-list-item v-for="item in items" :key="item.text" link>
                        <router-link class="top-navv-link" :to=item.link >{{item.text}}</router-link>
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