$(function()
{
    storeTraining();
    showModalTraining();
});

/**
 * トレーニングを追加
 */
function storeTraining()
{
    $(".add-training-btn").on("click",function () {
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

/**
 * トレーニングクリック時のモーダルを表示
 */
function showModalTraining()
{
    var data = {};

    var falseRemodal = $('[data-remodal-id=false-training-remodal]').remodal();
    var trueRemodal = $('[data-remodal-id=true-training-remodal]').remodal();


    $(document).on("click", ".this-training", function () {

        data = {
            "event_id"   : $(".this-event-show").data('event_id'),
            "training_id": $(this).data('training_id'),
            "stage_id": $(this).parent().data('stage_id'),
        };

        apiCheckMaxTraining(data,function(result){
            if(result === false){
                falseRemodal.open();
            }else if(result === true){
                trueRemodal.open();
            }
        });
    });

    $(document).on("click", ".delete-training-btn", function () {
        destroyTraining(data);
        falseRemodal.close();
    });

    $(document).on("click", ".on-max-training-btn", function () {
        onMaxTraining(data);
        falseRemodal.close();
    });

    $(document).on("click", ".off-max-training-btn", function () {
        offMaxTraining(data);
        trueRemodal.close();
    });
}

/**
 * トレーニング削除
 * @param data
 */
function destroyTraining(data)
{
    var training_box = $(`.this-training[data-training_id=${data.training_id}]`);
    var stage_id = training_box.parent().data('stage_id');

    apiDestroyTraining(data,function(){
        training_box.remove();
        var stage_ol = $(`.this-trainings .card ol[data-stage_id=${stage_id}]`);
        if(!stage_ol.find('li').is(':visible')){
            stage_ol.parent().remove();
        }
    });
}

/**
 * 最大強度に登録して、アンダーバーをつける
 * @param data
 */
function onMaxTraining(data)
{
    var training_box = $(`.this-trainings .this-training[data-training_id=${data.training_id}]`);

    apiOnMaxTraining(data,function(){
        $('.this-trainings ._add-underline').removeClass("_add-underline");
        training_box.addClass("_add-underline");
    });
}

/**
 * 最大強度の登録を外して、アンダーバー消す
 * @param data
 */
function offMaxTraining(data)
{
    apiOffMaxTraining(data,function(){
        $('.this-trainings ._add-underline').removeClass("_add-underline");
    });

}

