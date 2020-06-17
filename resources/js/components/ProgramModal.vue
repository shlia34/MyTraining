<template>
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">
                        <span @click="close">×</span>
                        <div class="modal-header">
                            <slot name="header">
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                <input type="date" v-model="formData.date">
                                <select v-model="formData.muscle_code">
                                    <option :value="muscle.id" v-for="muscle in muscleList">{{ muscle.name }}</option>
                                </select>
                                <input placeholder='メモ' type="input" v-model="formData.memo">
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button @click="store" class="modal-default-button remodal-btn store-program-btn">追加</button>
                            </slot>
                        </div>

                    </div>
                </div>
            </div>
        </transition>
</template>

<script>
    import {muscleNames} from '../const.js'

    export default {
        props:{
            isActive: Boolean,
        },
        data: function(){
            return{
                active: this.isActive,
                formData: {
                    muscle_code:"01",
                    date:this.getToday(),
                    memo:null,
                },
                muscleList:muscleNames,
            }
        },
        methods:{
            close:function () {
                this.$emit('closeModal');
            },
            store: function(){
                this.close();
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


<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }


    .store-program-btn{
        background-color: #F43E43;
    }
    .store-program-btn[disabled] {
        opacity: 0.5!important;
    }

</style>