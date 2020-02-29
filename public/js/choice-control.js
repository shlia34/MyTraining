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

            var target = $(`.part-group[data-part_code=${result['part_code']}] .user-stage`);
            target.append( buildStoreChoiceHtml(result) );
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

            var target = $(`.part-group[data-part_code=${result['part_code']}] .left-stage`);
            target.append( buildDestroyChoiceHtml(result) );
        });
    })
}
