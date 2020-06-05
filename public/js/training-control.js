$(function()
{
    storeWorkout();
    showModalTraining();
});

/**
 * トレーニングを追加
 */
function storeWorkout()
{
    $(".add-training-btn").on("click",function () {
        var program_id = $(".this-event-show").data('event_id');
        var exercise_id_val = $(".form-stage_id").val();
        var weight_val = $(".form-weight").val();
        var rep_val = $(".form-rep").val();

        var data = {
            "program_id":program_id,
            "exercise_id":exercise_id_val,
            "weight":weight_val,
            "rep":rep_val
        };

        apiStoreTraining(data,function(result){
            var menu_id = result['menu_id'];

            var ol_menu = $(`.this-trainings .card ol[data-menu_id=${menu_id}]`);

            if(!ol_menu.is(':visible')){
                $(".this-trainings").append(buildMenuCardHtml(result));
            }

            var menu_card = $(`.this-trainings .card ol[data-menu_id=${menu_id}]`);
            menu_card.append(buildWorkoutHtml(result));

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
            "program_id"   : $(".this-event-show").data('event_id'),
            "workout_id": $(this).data('workout_id'),
            "menu_id": $(this).parent().data('menu_id'),
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

