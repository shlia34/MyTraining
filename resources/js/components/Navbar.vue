<template>

    <v-app id="inspire">

    </v-app>
    <!--Navbar-->
<!--    <nav class="navbar fixed-top">-->
<!--        &lt;!&ndash; Navbar brand &ndash;&gt;-->
<!--        <router-link class="navbar-brand" to="/" >MyTraining</router-link>-->
<!--        &lt;!&ndash; Collapse button &ndash;&gt;-->
<!--        <button aria-controls="navbarSupportedContent23" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler second-button"-->
<!--                data-target="#navbarSupportedContent23" data-toggle="collapse" type="button">-->
<!--            <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>-->
<!--        </button>-->

<!--        &lt;!&ndash; Collapsible content &ndash;&gt;-->
<!--        <div class="collapse navbar-collapse" id="navbarSupportedContent23">-->
<!--            &lt;!&ndash; Links &ndash;&gt;-->
<!--            <ul class="navbar-nav mr-auto">-->
<!--                <li class="nav-item">-->
<!--                    <router-link class="nav-link" to="/exercises/index/01" ><i class="fas fa-cog"></i> 種目</router-link>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <router-link class="nav-link" to="/csv/index" ><i class="fas fa-file-csv"></i> CSV</router-link>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a @click="logout" class="nav-link">ログアウト</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            &lt;!&ndash; Links &ndash;&gt;-->
<!--        </div>-->
<!--        &lt;!&ndash; Collapsible content &ndash;&gt;-->
<!--    </nav>-->
<!--    &lt;!&ndash;/.Navbar&ndash;&gt;-->

</template>


<script>

    import {alertError} from '../alert'

    export default {
        mixins:[alertError],
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

</style>