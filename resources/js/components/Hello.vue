<template>
    <div><h2>Hello <span class="name">{{name}}</span></h2>!</div>
</template>

<script>
    export default {
        props: ['name']
    }
</script>
<style scoped>
    .name {
        font-weight: bold;
    }
</style>