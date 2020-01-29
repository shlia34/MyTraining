$(function(){

    createTraining();
    frontValidation();
    deleteTraining();
    recordMaxTraining();
    deleteMaxTraining();
    switchLink();

});


//todo ボタンじゃなくて、remodalで削除orお気に入りする
function switchLink()
{
    $(document).on("click", ".this-training", function () {

        var data = {
            "event_id"   : $(".this-event-show").data('event_id'),
            "training_id": $(this).data('training_id'),
        };

        ajaxCheckMaxTraining(data,function(result){
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

function buildSubBtnHtml(result)
{
    if(result === "nomal"){
        var html = `<span class = ""><i class="far fa-star non-max-training-btn"></i><i class="fas fa-times delete-training-btn"></i></span>`;
    }else if(result === "max"){
        html = `<span class = ""><i class="fas fa-star max-training-btn"></i></span>`;
    }
    return html;
}

function recordMaxTraining()
{
    $(document).on("click", ".non-max-training-btn", function () {

        var training_box = $(this).parent().parent();
        var data = {
            "event_id":$(".this-event-show").data('event_id'),
            "training_id":training_box.data('training_id'),
        };

        ajaxRecordMaxTraining(data,function(){
            $('.this-trainings ._add-underline').removeClass("_add-underline");
            training_box.addClass("_add-underline");
        });
    })

}

function deleteMaxTraining()
{

    $(document).on("click", ".this-event-show .max-training-btn", function () {

        var training_box = $(this).parent().parent();
        var data = {
            "event_id":$(".this-event-show").data('event_id'),
            "training_id":training_box.data('training_id'),
        };

        ajaxDeleteMaxTraining(data,function(){
            console.log($('.this-trainings ._add-underline'));
            $('.this-trainings ._add-underline').removeClass("_add-underline");
        });
    })

}



// todo    weightにバリデーションかけないとエラー起こる。4けた以上になっても透過。999以上は透過してる
function frontValidation()
{
    $(".form-weight").on('keyup', function(){
        var add_btn = $(".add-training-btn");

        if( !($(".form-weight").val().match(/\S/g) && !($(".form-weight").val() > 999 ))){
            add_btn.addClass("_transparent");
        } else {
            add_btn.removeClass("_transparent");
        }
    });
}

function deleteTraining()
{
    $(document).on("click", ".delete-training-btn", function () {
        var training_box = $(this).parent().parent();
        var training_id = training_box.data('training_id');
        var data = {"training_id":training_id};

        ajaxDeleteTraining(data,function(){
            training_box.remove();
        });
    })
}

function createTraining()
{
    $(".add-training-btn").on("click",function(){
        if( ($(".form-weight").val().match(/\S/g) )){
            transportTrainingDataToPhp();
        }
    })
}

function transportTrainingDataToPhp()
{
    var event_id = $(".this-event-show").data('event_id');
    var stage_code_val = $(".form-stage_code").val();
    var weight_val = $(".form-weight").val();
    var rep_val = $(".form-rep").val();

    var data = {
            "event_id":event_id,
            "stage_code":stage_code_val,
            "weight":weight_val,
            "rep":rep_val
    };

    ajaxStoreTraining(data,function(result){
        $('.space ul').append(buildTrainingHtml(result,weight_val,rep_val));
    });

}


//todo トレの表示はここを変えればおけ
function buildTrainingHtml(result,weight,rep)
{
    var html = `<li data-training_id = ${result['training_id']} class = "this-training"> ${result["stage_name"]} ${weight}kg * ${rep}rep `;
    return html;
}