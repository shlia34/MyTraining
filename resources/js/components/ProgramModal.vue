<template>

    <Modal @hideModal="hideModal">
        <template v-slot:body>
            <input type="date" v-model="formData.date">
                <select v-model="formData.muscle_code">
                    <option :value="muscle.code" v-for="muscle in muscleList" >{{ muscle.name }}</option>
                </select>
                <input placeholder='メモ' type="input" v-model="formData.memo">
        </template>
        <template v-slot:footer>
            <Btn :color="'#F43E43'" :isDisabled="memoValidation" :isModal="true" :text="'追加'" @clickBtn="store"></Btn>
        </template>
    </Modal>

</template>

<script>
    import {muscleNames} from '../const.js'
    import Btn from './Button'
    import Modal from './Modal'

    export default {
        props:{
            isActive: Boolean,
        },
        components:{ Btn,Modal },
        data: function(){
            return{
                active: this.isActive,
                formData: {
                    muscle_code:"01",
                    date:this.getToday(),
                    memo:"",
                },
                muscleList:muscleNames,
            }
        },
        computed: {
            memoValidation: function(){
                return this.formData.memo.length > 100;
            }
        },
        methods:{
            hideModal:function () {
                this.$emit('closeModal');
            },
            store: function(){
                this.hideModal();
                this.$emit('storeProgram', this.formData);
            },
            getToday: function () {
                var date = new Date();
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var day = date.getDate();

                var toTwoDigits = function (num, digit) {
                    num += '';
                    if (num.length < digit) {
                        num = '0' + num
                    }
                    return num
                };

                var yyyy = toTwoDigits(year, 4);
                var mm = toTwoDigits(month, 2);
                var dd = toTwoDigits(day, 2);
                return yyyy + "-" + mm + "-" + dd;
            }
        },
    }
</script>

<style></style>