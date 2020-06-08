//以下program
function apiStoreEvent(data,callback){
    $.ajax({
        url: '/api/programs/store',
        type: 'POST',
        dataTape: 'json',
        data: data,
    }).done(function(result) {
        callback(result);
    }).fail(function(result){
        var errors = result['responseJSON'].errors;

        $.each(errors, function(index, value) {
            alert(value);
        });

    })
}

function apiUpdateDateEvent(data){
    $.ajax({
        url: '/api/programs/updateDate',
        type: 'POST',
        data:data,
    }).done(function(result) {});
}

function apiShowLinksEvent(data, callback){
    $.ajax({
        url: '/api/programs/showLinks',
        type: 'POST',
        dataTape:'json',
        data:data,
    }).done(function(result) {
        callback(result);
    });
}

//以下workout
function apiStoreTraining(data, callback){
    $.ajax({
        url: '/api/workouts/store',
        type: 'POST',
        dataTape: 'json',
        data:data,
    }).done(function(result) {
        callback(result);
    });
}

function apiDestroyTraining(data, callback) {
    $.ajax({
        url: '/api/workouts/destroy',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

//以下workouts.is_max
function apiCheckMaxTraining(data, callback){
    $.ajax({
        url: '/api/workouts/max/check',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}


function apiOnMaxTraining(data, callback){
    $.ajax({
        url: '/api/workouts/max/on',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiOffMaxTraining(data, callback) {
    $.ajax({
        url: '/api/workouts/max/off',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

//以下routine
function apiStoreChoice(data, callback) {
    $.ajax({
        url: '/api/routines/store',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiDestroyChoice(data, callback) {
    $.ajax({
        url: '/api/routines/destroy',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiSortChoice(data, callback) {
    $.ajax({
        url: '/api/routines/sort',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

