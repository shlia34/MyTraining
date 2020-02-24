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
function apiStoreTraining(data, callback){
    $.ajax({
        url: '/api/trainings/store',
        type: 'POST',
        dataTape: 'json',
        data:data,
    }).done(function(result) {
        callback(result);
    });
}

function apiDestroyTraining(data, callback) {
    $.ajax({
        url: '/api/trainings/destroy',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

//以下trainings.is_max
function apiCheckMaxTraining(data, callback){
    $.ajax({
        url: '/api/trainings/max/check',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}


function apiOnMaxTraining(data, callback){
    $.ajax({
        url: '/api/trainings/max/on',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function ajaxOffMaxTraining(data, callback) {
    $.ajax({
        url: '/api/trainings/max/off',
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


