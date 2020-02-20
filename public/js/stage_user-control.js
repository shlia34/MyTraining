$(function(){

    storeStageUser();

});

function storeStageUser() {
    $(document).on("click", ".stage-user-store-btn", function () {

        var stage_box = $(this).parent();
        var data = {
            "stage_id":stage_box.data('stage_id'),
        };


        ajaxStoreStageUser(data,function(result){
            console.log(result);
        });
    })
}

function ajaxStoreStageUser(data,callback) {
    $.ajax({
        url: '/ajax/stage_user/store',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}
