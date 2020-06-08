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

/**
 * イベントの日付を変更
 * event/index.blade.phpで使用
 * @param info
 */
function updateDateProgram(info)
{
    var data = {
        "id":info.event.id,
        "new_date":info.event.start.toISOString(),
    };
    apiUpdateDateProgram(data,function(result){
    });
}

/**
 * イベント詳細ページへのリンクを表示
 * event/index.blade.phpで使用
 * @param date
 */
function showLinksProgram(date)
{
    var data = {date:date};
    apiShowLinksProgram(data,function(result){
        $('.show-program ul').empty();
        $('.show-program p').empty();
        $('.show-program p').append(result["date"]);
        $.each(result["programs"], function(index, value) {
            $('.show-program ul').append( buildLinksProgramHtml(value) );
        });
    });
}