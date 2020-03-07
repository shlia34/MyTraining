$(function() {

    $( ".user-stage" ).sortable({
        connectWith: ".left-stage",
        placeholder: "placeholder",
        forcePlaceholderSize: true,
        receive: function(event,ui) { storeChoice(event, ui) },
        stop: function(event) { sortChoice(event) },
    });

    $( ".left-stage" ).sortable({
        connectWith: ".user-stage",
        placeholder: "placeholder",
        forcePlaceholderSize: true,
        receive: function(event, ui) { destroyChoice(event, ui) }
    });
});

function storeChoice(event, ui) {
    var data = { "stage_id":ui.item.data('stage_id') };

    apiStoreChoice(data,function(result){
        sortChoice(event);
    });
}

function destroyChoice(event, ui) {
    var data = { "stage_id":ui.item.data('stage_id') };

    apiDestroyChoice(data,function(result){});
}

function sortChoice(event){
    var htmlArr = Array.prototype.slice.call(event.target.children);

    var stageIds = [];
    htmlArr.forEach(function(item) {
        stageIds.push(item.getAttribute("data-stage_id"));
    });

    var data = { stage_ids:stageIds };

    apiSortChoice(data,function(result){});
}