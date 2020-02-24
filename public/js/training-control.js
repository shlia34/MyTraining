$(function()
{
    storeTraining();
    destroyTraining();

    onMaxTraining();
    offMaxTraining();
    checkMaxTraining();

    frontValidation();
});

function storeTraining()
{
    $(document).on("click", ".add-training-btn", function () {
        var event_id = $(".this-event-show").data('event_id');
        var stage_id_val = $(".form-stage_id").val();
        var weight_val = $(".form-weight").val();
        var rep_val = $(".form-rep").val();

        var data = {
            "event_id":event_id,
            "stage_id":stage_id_val,
            "weight":weight_val,
            "rep":rep_val
        };

        apiStoreTraining(data,function(result){
            var stage_id = result['stage_id'];
            var ol_stage_id = $(`.this-trainings .card ol[data-stage_id=${stage_id}]`)

            if(!ol_stage_id.is(':visible')){
                $(".this-trainings").append(buildStageCardHtml(result));
            }

            var stage_card = $(`.this-trainings .card ol[data-stage_id=${stage_id}]`);
            stage_card.append(buildTrainingHtml(result,weight_val,rep_val));

        });
    })

}

function destroyTraining()
{
    $(document).on("click", ".delete-training-btn", function () {
        var training_box = $(this).parent().parent();
        var training_id = training_box.data('training_id');
        var stage_id = training_box.parent().data('stage_id');
        var data = {"training_id":training_id};

        apiDestroyTraining(data,function(){
            training_box.remove();
            var stage_ol = $(`.this-trainings .card ol[data-stage_id=${stage_id}]`);
            if(!stage_ol.find('li').is(':visible')){
                stage_ol.parent().remove();
            }

        });
    })
}

function onMaxTraining()
{
    $(document).on("click", ".non-max-training-btn", function () {

        var training_box = $(this).parent().parent();
        var data = {
            "event_id":$(".this-event-show").data('event_id'),
            "training_id":training_box.data('training_id'),
        };

        apiOnMaxTraining(data,function(){
            $('.this-trainings ._add-underline').removeClass("_add-underline");
            training_box.addClass("_add-underline");
        });
    })

}

function offMaxTraining()
{
    $(document).on("click", ".this-event-show .max-training-btn", function () {

        var training_box = $(this).parent().parent();
        var data = {
            // "event_id":$(".this-event-show").data('event_id'),
            "training_id":training_box.data('training_id'),
        };

        apiOffMaxTraining(data,function(){
            $('.this-trainings ._add-underline').removeClass("_add-underline");
        });
    })

}

//todo ボタンじゃなくて、remodalで削除orお気に入りする
function checkMaxTraining()
{
    $(document).on("click", ".this-training", function () {

        var data = {
            "event_id"   : $(".this-event-show").data('event_id'),
            "training_id": $(this).data('training_id'),
        };

        apiCheckMaxTraining(data,function(result){
            if ($('.this-event-show .non-max-training-btn').is(':visible') || $('.this-event-show .max-training-btn').is(':visible') ) {
                $(".non-max-training-btn").hide();
                $(".max-training-btn").hide();
                $(".delete-training-btn").hide();
            } else {
                var target =  $(`li[data-training_id=${data.training_id}`);
                target.append(buildSubBtnHtml(result));
            }
        });
    });
}

function frontValidation()
{
    $(".form-weight,.form-rep").on('keyup', function(){
        var add_btn = $(".add-training-btn");

        var weight_val= $(".form-weight").val();
        var weight_validation_error = weight_val == "" || /^0/.test(weight_val)　|| weight_val > 1000 || /[/.][0-9]{2,}/.test(weight_val);
        // 整数部分は3桁以内、少数部分は1桁以内の数字を許可する
        // ①空か②0から始まらないか③整数部分は3桁以内か④小数値が2個以上続かないか
        var rep_val= $(".form-rep").val();

        var rep_validation_error = rep_val == "" || /^0/.test(rep_val)　|| rep_val > 100 || /[/.]/.test(rep_val);
        //  少数を許さない整数2桁以内
        //todo val()ではピリオドが取得できない。「11.」を「11」として取得してしまうので困ってる。

        if( weight_validation_error == true || rep_validation_error == true ){
            add_btn.prop("disabled", true);
        } else {
            add_btn.prop("disabled", false);
        }
    });
}
