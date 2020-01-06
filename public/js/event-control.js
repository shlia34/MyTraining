function addEvent(calendar,info){

    var part_code = $(".remodal-part_code").val();
    var memo = $(".remodal-memo").val();

    $.ajax({
        url: '/ajax/addEvent',
        type: 'POST',
        dataTape: 'json',
        data:{
            "part_code":part_code,
            "memo":memo,
            "date":info.dateStr
        }
    }).done(function(result) {
        calendar.addEvent({
            id:result['event_id'],
            title:result['part_name'],
            start: info.dateStr,
        });
    });
}

function editEventDate(info){
    var id = info.event.id;
    var date = formatDate(info.event.start);

    $.ajax({
        url: '/ajax/editEventDate',
        type: 'POST',
        data:{
            "id":id,
            "newDate":date
        }
    })
}

function showEventsByDate(date){

    if(typeof date === "object"){
        date = formatDate(date);
    }

    $.ajax({
        url: '/ajax/showEventsByDate',
        type: 'POST',
        dataTape:'json',
        data:{
            date:date
        }
    }).done(function(result) {
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