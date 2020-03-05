$(function() {

    $( ".user-stage" ).sortable({
        connectWith: ".left-stage",
        dropOnEmpty: true,
        receive: function(event,ui) {
            console.log("user_stageに追加された");

            var data = {
                "stage_id":ui.item.data('stage_id'),
            };

            apiStoreChoice(data,function(result){
            });
        }
    });

    $( ".left-stage" ).sortable({
        connectWith: ".user-stage",
        dropOnEmpty: true,
        receive: function(event, ui) {
            console.log("user_stageから除外された");

            var data = {
                "stage_id":ui.item.data('stage_id'),
            };

            apiDestroyChoice(data,function(result){
            });
        }
    });
});