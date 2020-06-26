<template>
    <div class = "title">{{ text }}</div>
</template>

<script>
    export default {
        props:{
            text:"",
        }
    }

</script>

<style>
    .title {
        background-color: #454545;
        color: white;
        font-weight: bold;
        line-height: 40px;
        height: 40px;
        margin-top: 10px;
        padding-left: 10px;
    }

</style>