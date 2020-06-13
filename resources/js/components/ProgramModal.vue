<template>
    <div v-show="active">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                default header
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                default body
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                default footer
                                <button @click="close" class="modal-default-button">
                                    OK
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>



<!--    <div class="program-remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">-->
<!--        <button data-remodal-action="close" class="remodal-close"></button>-->
<!--        &lt;!&ndash;        {{Form::date('date', \Carbon\Carbon::now(), ['class'=>'remodal-date'])}}&ndash;&gt;-->
<!--        &lt;!&ndash;        {{Form::select('muscle_code', App\Defs\DefMuscle::MUSCLE_NAME_LIST,null,['class' => 'remodal-muscle_code'])}}&ndash;&gt;-->
<!--        &lt;!&ndash;        {{Form::input('text', 'memo',null,['class' => 'remodal-memo','placeholder'=>'メモ'])}}&ndash;&gt;-->
<!--        <button data-remodal-action="confirm" class="remodal-btn store-program-btn">追加</button>-->
<!--    </div>-->
</template>

<script>
    export default {
        props:{
            isActive: Boolean,
        },
        data(){
            return{
                active: this.isActive,
            }
        },
        methods:{
            close:function () {
                this.active = false;
                console.log(12121);
                console.log(this);
                console.log(this.active);
            },
            storeProgram: function(){
                $(document).off('confirmation').on('confirmation', '.program-remodal', function () {
                    var data = {
                        "muscle_code":$(".remodal-muscle_code").val(),
                        "memo":$(".remodal-memo").val(),
                        "date":$(".remodal-date").val(),
                    };
                    console.log(data);
                });
            },
        }
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

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

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

</style>