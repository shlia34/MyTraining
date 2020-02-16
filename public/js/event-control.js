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
    ajaxEditEventDate(data);
}

function showEventsByDate(date)
{
    var data = {date:date};
    ajaxShowEventsByDate(data,function(result){
        appendEventHtml(result);
    });
}

function appendEventHtml(result) {
    $('.show-event ul').empty();
    $('.show-event p').empty();
    $('.show-event p').append(result["date"]);
    //todo 横並び、トレ名追加
    $.each(result["events"], function(index, value) {
        $('.show-event ul').append( buildEvenShowHtml(value) );
    });
}


//todo ここでhtmlを変える
function buildEvenShowHtml(value) {
    var html ="<li>" + "<a href='/event/" + value["id"] + "'>"+ value["title"] +"</a>"+ value["stage_name"] + value["weight_and_rep"] +"</li>";
    return html;
}
