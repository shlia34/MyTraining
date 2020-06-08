//以下program
function apiStoreProgram(data, callback){
    $.ajax({
        url: '/api/programs/store',
        type: 'POST',
        dataTape: 'json',
        data: data,
    }).done(function(result) {
        callback(result);
    }).fail(function(result){
        alertError(result);

    })
}

function apiUpdateDateProgram(data){
    $.ajax({
        url: '/api/programs/updateDate',
        type: 'POST',
        data:data,
    }).fail(function(result){
        alertError(result);
    })
}

function apiShowLinksProgram(data, callback){
    $.ajax({
        url: '/api/programs/showLinks',
        type: 'POST',
        dataTape:'json',
        data:data,
    }).done(function(result) {
        callback(result);
    }).fail(function(result){
        alertError(result);
    });
}

//以下workout
function apiStoreWorkout(data, callback){
    $.ajax({
        url: '/api/workouts/store',
        type: 'POST',
        dataTape: 'json',
        data:data,
    }).done(function(result) {
        callback(result);
    });
}

function apiDestroyWorkout(data, callback) {
    $.ajax({
        url: '/api/workouts/destroy',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

//以下workouts.is_max
function apiCheckMaxWorkout(data, callback){
    $.ajax({
        url: '/api/workouts/max/check',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}


function apiOnMaxWorkout(data, callback){
    $.ajax({
        url: '/api/workouts/max/on',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiOffMaxWorkout(data, callback) {
    $.ajax({
        url: '/api/workouts/max/off',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

//以下routine
function apiStoreRoutine(data, callback) {
    $.ajax({
        url: '/api/routines/store',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiDestroyRoutine(data, callback) {
    $.ajax({
        url: '/api/routines/destroy',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

function apiSortRoutine(data, callback) {
    $.ajax({
        url: '/api/routines/sort',
        type: 'POST',
        data: data,
    }).done(function(result) {
        callback(result);
    });
}

//ajax失敗したとき、errorをalertで出す
function alertError(result) {
    var errors = result['responseJSON'].errors;

    $.each(errors, function(index, value) {
        alert(value);
    });
}