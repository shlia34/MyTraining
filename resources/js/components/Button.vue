<template>
    <v-btn :class="{modal_btn: isModal}"
           :color="color"
           :disabled="isDisabled"
           :style="styles"
           @click="clickHandler"
           class="btn"
           depressed large
    >{{text}}</v-btn>
</template>

<script>
    export default {
        props: {
            color:{},
            text:{},
            isModal:false,
            isDisabled:false,
            isSubmit:false
        },
        methods: {
            clickHandler: function () {
                this.$emit('clickBtn');
            }
        },
        computed: {
            styles() {
                return {
                    '--color': this.color,
                }
            }
        }

    }

</script>

<style scoped>
    .btn {
        color: white!important;
    }

    .modal_btn{
        width: 250px;
        height: 60px;
        color: white!important;
        margin: 5px;
    }


</style>
