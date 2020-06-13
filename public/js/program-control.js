/**
 * イベント追加
 * event/index.blade.phpで使用
 * @param calendar
 */
function storeProgram(calendar)
{
    var data = {
        "muscle_code":$(".remodal-muscle_code").val(),
        "memo":$(".remodal-memo").val(),
        "date":$(".remodal-date").val(),
    };

    apiStoreProgram(data, function(result){

        calendar.addEvent({
            id:result['id'],
            title:result['title'],
            muscle_code:result['muscle_code'],
            url:result['url'],
            backgroundColor:result['backgroundColor'],
            borderColor:result['borderColor'],
            start: result['start'],
        });
        showLinksProgram(result['start']);
    })
}

$(function()
{
    alertDestroyProgram();
});

function alertDestroyProgram() {
    $(document).on("click", ".fa-trash", function () {
        alert('本当に消しますか？？？');
    });

}