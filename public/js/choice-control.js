$(function(){

    storeChoice();
    destroyChoice();

});

function storeChoice() {
    $(document).on("click", ".stage-user-store-btn", function () {

        var stage_box = $(this).parent();
        var data = {
            "stage_id":stage_box.data('stage_id'),
        };

        apiStoreChoice(data,function(result){
            stage_box.remove();

            var part_div = $(`.user-stage .user-part-group[data-part_code=${result['part_code']}]`);
            part_div.append( buildStoreChoiceHtml(result) );
        });
    })
}

function destroyChoice() {
    $(document).on("click", ".stage-user-delete-btn", function () {

        var stage_box = $(this).parent();
        var data = {
            "stage_id":stage_box.data('stage_id'),
        };

        apiDestroyChoice(data,function(result){
            stage_box.remove();

            var part_div = $(`.left-stage .left-part-group[data-part_code=${result['part_code']}]`);
            part_div.append( buildDestroyChoiceHtml(result) );
        });
    })
}
