function storeEvent(calendar)
{
    var data = {
        "part_code":$(".remodal-part_code").val(),
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

function updateDateEvent(info)
{
    var data = {
        "id":info.event.id,
        "newDate":info.event.start.toISOString(),
    };
    apiUpdateDateEvent(data);
}

function showLinksEvent(date)
{
    var data = {date:date};
    apiShowLinksEvent(data,function(result){
        appendLinksEvent(result);
    });
}

function appendLinksEvent(result) {
    $('.show-event ul').empty();
    $('.show-event p').empty();
    $('.show-event p').append(result["date"]);
    $.each(result["events"], function(index, value) {
        $('.show-event ul').append( buildHtmlLinksEvent(value) );
    });
}

function buildHtmlLinksEvent(value) {
    var html ="<li>" + "<a href='/event/" + value["id"] + "'>"+ value["title"] +"</a>"+ value["stage_name"] + value["weight_and_rep"] +"</li>";
    return html;
}
