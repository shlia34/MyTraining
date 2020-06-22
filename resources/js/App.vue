<template>
    <div>
        <Navbar></Navbar>

        <div class = "wrapper">
            <RouterView />
        </div>
    </div>

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
    .wrapper {
        font-size: 18px;
    }
</style>