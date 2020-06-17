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
    console.log(result);
    var errors = result['responseJSON'].errors;

    $.each(errors, function(index, value) {
        alert(value);
    });
}