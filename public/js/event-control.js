function addEvent(calendar)
{
    var data = {
        "part_code":$(".remodal-part_code").val(),
        "memo":$(".remodal-memo").val(),
        "date":$(".remodal-date").val(),
    };

    ajaxAddEvent(data, function(result){
        calendar.addEvent({
            id:result['id'],
            title:result['title'],
            part_code:result['part_code'],
            url:result['url'],
            backgroundColor:result['backgroundColor'],
            borderColor:result['borderColor'],
            start: result['start'],
        });
        showEventsByDate(result['start']);
    })
}

//todo update
function editEventDate(info)
{
    var data = {
        "id":info.event.id,
        "newDate":info.event.start.toISOString(),
    };
    console.log(info.event);
    ajaxEditEventDate(data);
}

function showEventsByDate(date)
{
    var data = {date:date};
    ajaxShowEventsByDate(data,function(result){
        appendEventHtml(result,date);
    });
}

function appendEventHtml(result,date) {
    $('.show-event ul').empty();
    $('.show-event p').empty();
    $('.show-event p').append(date);

    //todo 横並び、トレ名追加
    $.each(result, function(index, value) {
        $('.show-event ul').append( "<li>" + "<a href='/event/" + value["id"] + "'>"+ value["title"] +"</a>"+"</li>" );
    });
}
