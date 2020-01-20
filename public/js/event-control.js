function addEvent(calendar,info)
{
    var data = {
        "part_code":$(".remodal-part_code").val(),
        "memo":$(".remodal-memo").val(),
        "date":info.dateStr
    };

    ajaxAddEvent(data, function(result){
        calendar.addEvent({
            id:result['event_id'],
            title:result['title'],
            part_code:result['part_code'],
            backgroundColor:result['backgroundColor'],
            borderColor:result['borderColor'],
            start: info.dateStr,
        });
    })
}

function editEventDate(info)
{
    var data = {
        "id":info.event.id,
        "newDate":formatDate(info.event.start)
    };
    ajaxEditEventDate(data);
}

function showEventsByDate(date)
{
    if(typeof date === "object"){
        date = formatDate(date);
    }
    var data = {date:date};
    ajaxShowEventsByDate(data,function(result){
        appendEventHtml(result,date);
    });

}

function appendEventHtml(result,date) {
    $('.show-event ul').empty();
    $('.show-event p').empty();
    $('.show-event p').append(date);

    $.each(result, function(index, value) {
        $('.show-event ul').append("<li>" + value["title"] + "</li>");
        $('.show-event ul').append( "<a href='/event/" + value["id"] + "'>詳細へ</a>" );

    });
}

function formatDate(date) {
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var newDate = year + '-' + month + '-' + day;
    return newDate;
}