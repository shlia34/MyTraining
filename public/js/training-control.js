$(function(){

    createTraining();


    $(".form-weight").on('keyup', function(){
        var add_btn = $(".add-training-btn");

        if( !($(".form-weight").val().match(/\S/g) )){
            add_btn.addClass("_transparent");
        } else {
            add_btn.removeClass("_transparent");
        }
    });

});

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
        $('.space').append(buildTrainingHtml(result,weight_val,rep_val));
    });


}

function buildTrainingHtml(part_name,weight,rep){
    var html = "<ul>" + "<li>" + part_name + "</li>"+ "<li>" + weight+ "kg * " + rep + "rep" + "</li></ul>"

    return html;
}