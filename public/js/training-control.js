$(function(){

    createTraining();
    frontValidation();
    deleteTraining();

});

// todo    weightにバリデーションかけないとエラー起こる。4けた以上になっても透過。
function frontValidation() {
    $(".form-weight").on('keyup', function(){
        var add_btn = $(".add-training-btn");

        if( !($(".form-weight").val().match(/\S/g) )){
            add_btn.addClass("_transparent");
        } else {
            add_btn.removeClass("_transparent");
        }
    });
}

function createTraining(){

    $(".add-training-btn").on("click",function(){
        if( ($(".form-weight").val().match(/\S/g) )){
            transportDataToPhp();
        }
    })
}

function transportDataToPhp(){

    var event_id = $(".event-show").attr('id');
    var stage_code_val = $(".form-stage_code").val();
    var weight_val = $(".form-weight").val();
    var rep_val = $(".form-rep").val();

    $.ajax({
        url: '/ajax/storeTraining',
        type: 'POST',
        dataTape: 'json',
        data:{
            "event_id":event_id,
            "stage_code":stage_code_val,
            "weight":weight_val,
            "rep":rep_val
        }
    }).done(function(result) {
        $('.space ul').append(buildTrainingHtml(result,weight_val,rep_val));
    });

}

function buildTrainingHtml(result,weight,rep){
    console.log(result);
    var html = `<li> ${result["stage_name"]} ${weight}kg * ${rep}rep `;
    html += `<i id = ${result['training_id']} class='fas fa-times delete-training-btn'></i>`;

    return html;
}

function deleteTraining(){
    $(document).on("click", ".delete-training-btn", function () {

        var training_id = $(this).attr('id');
        var remove_target =  $(this).parent();

        $.ajax({
            url: '/ajax/deleteTraining',
            type: 'POST',
            data:{
                "training_id":training_id,
            }
        }).done(function() {
            remove_target.remove();
        });
    })
}