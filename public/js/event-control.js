/**
 * イベント追加
 * event/index.blade.phpで使用
 * @param calendar
 */
function storeEvent(calendar)
{
    var data = {
        "muscle_code":$(".remodal-part_code").val(),
        "memo":$(".remodal-memo").val(),
        "date":$(".remodal-date").val(),
    };

    apiStoreEvent(data, function(result){

        calendar.addEvent({
            id:result['id'],
            title:result['title'],
            part_code:result['part_code'],
            url:result['url'],
            backgroundColor:result['backgroundColor'],
            borderColor:result['borderColor'],
            start: result['start'],
        });
        showLinksEvent(result['start']);
    })
}

/**
 * イベントの日付を変更
 * event/index.blade.phpで使用
 * @param info
 */
function updateDateEvent(info)
{
    var data = {
        "id":info.event.id,
        "newDate":info.event.start.toISOString(),
    };
    apiUpdateDateEvent(data);
}

/**
 * イベント詳細ページへのリンクを表示
 * event/index.blade.phpで使用
 * @param date
 */
function showLinksEvent(date)
{
    var data = {date:date};
    apiShowLinksEvent(data,function(result){
        $('.show-event ul').empty();
        $('.show-event p').empty();
        $('.show-event p').append(result["date"]);
        $.each(result["events"], function(index, value) {
            $('.show-event ul').append( buildLinksEventHtml(value) );
        });
    });
}