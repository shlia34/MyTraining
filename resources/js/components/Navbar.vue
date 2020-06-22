<template>

    <!--Navbar-->
    <nav class="navbar fixed-top">
        <!-- Navbar brand -->
        <router-link class="navbar-brand" to="/" >MyTraining</router-link>
        <!-- Collapse button -->
        <button aria-controls="navbarSupportedContent23" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler second-button"
                data-target="#navbarSupportedContent23" data-toggle="collapse" type="button">
            <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent23">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" to="/exercises/index/01" ><i class="fas fa-cog"></i> 種目</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/csv/index" ><i class="fas fa-file-csv"></i> CSV</router-link>
                </li>
                <li class="nav-item">
                    <a @click="logout" class="nav-link">ログアウト</a>
<!--                       onclick="event.preventDefault();-->
<!--                       document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> ログアウト</a>-->
<!--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">-->
<!--                        @csrf-->
<!--                    </form>-->
                </li>
            </ul>
            <!-- Links -->
        </div>
        <!-- Collapsible content -->
    </nav>
    <!--/.Navbar-->

</template>


<script>
    export default {
        methods:{
            logout:function(){
                var response = axios.post('/logout').then(function (response) {
                    console.log("logouted");
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