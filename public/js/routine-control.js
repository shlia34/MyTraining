/**
 * jQueryUIのライブラリを使用
 * ドキュメント(https://api.jqueryui.com/sortable/)
 * 参考(http://cly7796.net/wp/javascript/try-the-sortable-of-jquery-ui/)
 */
$(function() {

    $( ".user-stage" ).sortable({
        connectWith: ".left-stage",
        //sortableを設定している他の要素へドラッグへ移動したい場合に指定
        placeholder: "placeholder",
        //ドラッグ時の空白の領域に入る要素のclass名指定
        forcePlaceholderSize: true,
        //placeholderのサイズ保持
        receive: function(event,ui) { storeChoice(event, ui) },
        //別のリストから並び替え要素がドロップされたときに発火
        stop: function(event) { sortChoice(event) },
        //並び替えを停止した時に発火
    });

    $( ".left-stage" ).sortable({
        connectWith: ".user-stage",
        placeholder: "placeholder",
        forcePlaceholderSize: true,
        receive: function(event, ui) { destroyChoice(event, ui) }
    });
});

/**
 * 種目選択の追加
 * @param event
 * @param ui
 */
function storeChoice(event, ui) {
    var data = { "exercise_id":ui.item.data('exercise_id') };

    apiStoreChoice(data,function(result){
        sortChoice(event);
    });
}

/**
 * 種目選択の削除
 * @param event
 * @param ui
 */
function destroyChoice(event, ui) {
    var data = { "exercise_id":ui.item.data('exercise_id') };

    apiDestroyChoice(data,function(result){});
}

/**
 * ドラックアンドドロップで並び替え
 * @param event
 */
function sortChoice(event){
    var htmlArr = Array.prototype.slice.call(event.target.children);
    //stage_idを上から順に取得

    var stageIds = [];
    htmlArr.forEach(function(item) {
        stageIds.push(item.getAttribute("data-exercise_id"));
    });

    var data = { exercise_ids:stageIds };

    apiSortChoice(data,function(result){});
}