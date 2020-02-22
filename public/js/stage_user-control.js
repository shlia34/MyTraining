$(function(){

    storeStageUser();
    deleteStageUser();

});

function storeStageUser() {
    $(document).on("click", ".stage-user-store-btn", function () {

        var stage_box = $(this).parent();
        var data = {
            "stage_id":stage_box.data('stage_id'),
        };


        ajaxStoreStageUser(data,function(result){
            stage_box.remove();

            var part_div = $(`.user-stage .user-part-group[data-part_code=${result['part_code']}]`);
            part_div.append( buildHtmlStageUserStore(result) );
        });
    })
}

function buildHtmlStageUserStore(result) {
    var html = `<div class ="" data-stage_id= ${result['stage_id']} ><a href= "/stage/${result['stage_id']}">${result['stage_name']}</a>`;
    html += "<a class=\"stage-user-delete-btn\">削除</a></div>";
    return html;
}

function deleteStageUser() {
    $(document).on("click", ".stage-user-delete-btn", function () {

        var stage_box = $(this).parent();
        var data = {
            "stage_id":stage_box.data('stage_id'),
        };


        ajaxDeleteStageUser(data,function(result){
            stage_box.remove();

            var part_div = $(`.left-stage .left-part-group[data-part_code=${result['part_code']}]`);
            part_div.append( buildHtmlStageUserDelete(result) );
        });
    })
}

function buildHtmlStageUserDelete(result) {
    var html = `<div class ="" data-stage_id= ${result['stage_id']}><a href= "/stage/${result['stage_id']}">${result['stage_name']}</a>`;
    html += "<a class=\"stage-user-store-btn\">追加</a></div>";
    return html;
}


function ajaxDeleteStageUser(data,callback) {
    $.ajax({
        url: '/ajax/stage_user/delete',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
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
