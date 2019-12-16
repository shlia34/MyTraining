function setEvents(calendar){
    $.ajax({
        url:'/ajax/setEvents',
        type:'post',
        dataType:'json',
    }).done(function(result) {
        $.each(result, function(index, value) {
            calendar.addEvent({
                id:value['event_id'],
                title:value['part_name'],
                start:value['date'],
            });
        });
    });
}


function addEvent(calendar,info){

    var id = generateUuid();
    var part_code = $(".remodal-part_code").val();
    var memo = $(".remodal-memo").val();

    $.ajax({
        url: '/ajax/addEvent',
        type: 'POST',
        dataTape: 'json',
        data:{
            "id": id,
            "part_code":part_code,
            "memo":memo,
            "date":info.dateStr
        }
    }).done(function(result) {
        calendar.addEvent({
            id:id,
            title:result,
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

function generateUuid(){
    function s4() {
        return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    }
    var uuid = s4() + s4()  + s4() + s4()  + s4()  + s4() + s4() + s4();
    return uuid;
}

function formatDate(date) {
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var newDate = year + '-' + month + '-' + day;
    return newDate;
}