<template>
    <button @click="clickHandler"
            :style="styles"
            class = "btn waves-effect w-30 ml-4"
            :class="{modal_btn: isModal}"
            type="button">{{text}}</button>
</template>

<script>
    export default {
        props: {
            color:{},
            text:{},
            isModal:false,
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
        /* デフォルトの値を宣言*/
        --color: grey;

        /* CSS変数を背景と幅に割り当て */
        background-color: var(--color)!important;
        color: white!important;
    }


    .btn[disabled] {
        opacity: 0.5!important;
    }


    .modal_btn{
        width: 250px;
        height: 60px;
        color: white!important;
        margin: 5px;
    }


</style>
