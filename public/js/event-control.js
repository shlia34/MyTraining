function addEvent(calendar,info){

    var id = generateUuid();
    // console.log(id);
    // console.log(part_code);
    // var title = $("#remodal-title").val();
    var title = "test";
    // var description = $("#remodal-description").val();

    calendar.addEvent({
        id:id,
        title:title,
        start: info.dateStr,
    });

    $.ajax({
        url: '/ajax/addEvent',
        type: 'POST',
        data:{
            "id": id,
            // "part_code":part_code,
            // "memo":memo,
            "start":info.dateStr
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

function getPartName(){
    // codeを定数配列を利用して、文字にへんかん。それをタイトルに挿入する。
}
