//以下event
function ajaxAddEvent(data,callback){
    $.ajax({
        url: '/ajax/addEvent',
        type: 'POST',
        dataTape: 'json',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function ajaxEditEventDate(data){
    $.ajax({
        url: '/ajax/editEventDate',
        type: 'POST',
        data:data,
    }).done(function(result) {});
}

function ajaxShowEventsByDate(data,callback){
    $.ajax({
        url: '/ajax/showEventsByDate',
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


