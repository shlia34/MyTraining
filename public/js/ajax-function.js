//以下event
function apiStoreEvent(data,callback){
    $.ajax({
        url: '/api/events/store',
        type: 'POST',
        dataTape: 'json',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiUpdateDateEvent(data){
    $.ajax({
        url: '/api/events/updateDate',
        type: 'POST',
        data:data,
    }).done(function(result) {});
}

function apiShowLinksEvent(data, callback){
    $.ajax({
        url: '/api/events/showLinks',
        type: 'POST',
        dataTape:'json',
        data:data,
    }).done(function(result) {
        callback(result);
    });
}

//以下training
function ajaxCheckMaxTraining(data,callback){
    $.ajax({
        url: '/ajax/checkMaxTraining',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}


function ajaxRecordMaxTraining(data,callback){
    $.ajax({
        url: '/ajax/recordMaxTraining',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function ajaxDeleteMaxTraining(data,callback) {
    $.ajax({
        url: '/ajax/deleteMaxTraining',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function ajaxStoreTraining(data,callback){
    $.ajax({
        url: '/ajax/storeTraining',
        type: 'POST',
        dataTape: 'json',
        data:data,
    }).done(function(result) {
        callback(result);
    });
}

function ajaxDeleteTraining(data,callback) {
    $.ajax({
            url: '/ajax/deleteTraining',
            type: 'POST',
            data: data,
        }).done(function(result) {
        callback(result);
    });
}
//以下stage_user
// function ajaxStoreStageUser(data,callback) {
//     $.ajax({
//             url: '/ajax/stage_user/store',
//             type: 'POST',
//             data: data,
//         }).done(function(result) {
//         callback(result);
//     });
// }


