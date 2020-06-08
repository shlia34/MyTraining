/**
 * jQueryUIのライブラリを使用
 * ドキュメント(https://api.jqueryui.com/sortable/)
 * 参考(http://cly7796.net/wp/javascript/try-the-sortable-of-jquery-ui/)
 */
$(function() {

    $( ".routines" ).sortable({
        connectWith: ".not-routines",
        //sortableを設定している他の要素へドラッグへ移動したい場合に指定
        placeholder: "placeholder",
        //ドラッグ時の空白の領域に入る要素のclass名指定
        forcePlaceholderSize: true,
        //placeholderのサイズ保持
        receive: function(event,ui) { storeRoutine(event, ui) },
        //別のリストから並び替え要素がドロップされたときに発火
        stop: function(event) { sortRoutine(event) },
        //並び替えを停止した時に発火
    });

    $( ".not-routines" ).sortable({
        connectWith: ".routines",
        placeholder: "placeholder",
        forcePlaceholderSize: true,
        receive: function(event, ui) { destroyRoutine(event, ui) }
    });
});

/**
 * 種目選択の追加
 * @param event
 * @param ui
 */
function storeRoutine(event, ui) {
    var data = { "exercise_id":ui.item.data('exercise_id') };

    apiStoreRoutine(data,function(result){
        sortRoutine(event);
    });
}

/**
 * 種目選択の削除
 * @param event
 * @param ui
 */
function destroyRoutine(event, ui) {
    var data = { "exercise_id":ui.item.data('exercise_id') };

    apiDestroyRoutine(data,function(result){});
}

/**
 * ドラックアンドドロップで並び替え
 * @param event
 */
function sortRoutine(event){
    var htmlArr = Array.prototype.slice.call(event.target.children);
    //stage_idを上から順に取得

    var exerciseIds = [];
    htmlArr.forEach(function(item) {
        exerciseIds.push(item.getAttribute("data-exercise_id"));
    });

    var data = { exercise_ids:exerciseIds };

    apiSortRoutine(data,function(result){});
}