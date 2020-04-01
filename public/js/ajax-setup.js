/**
 * laravelのドキュメントに書いてるやつをコピペしただけ
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});