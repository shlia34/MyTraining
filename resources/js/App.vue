<template>
    <v-app>
        <Navbar>

        </Navbar>
        <div class="wrapper">
            <RouterView />
        </div>
    </v-app>
</template>

<script>
    import Navbar from './components/Navbar'

    export default {
        components: {
            Navbar,
        },
    }

</script>

<style>
    body {
        background-color:white;
        font-size: 18px;
        color:white;
    }

    .wrapper{
        padding-top: 56px;
    }






</style>