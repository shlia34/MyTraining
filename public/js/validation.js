$(function()
{
    weightAndRepValidation();
    programMemoValidation();
});


function weightAndRepValidation()
{
    $(".form-weight,.form-rep").on('keyup', function(){
        var addBtn = $(".add-workout-btn");

        var weightVal= $(".form-weight").val();
        var weightValidationError = weightVal == "" || weightVal ==  0  || weightVal > 999.9 || (/^[0][0-9]/).test(weightVal)　|| /[/.][0-9]{2,}/.test(weightVal);
        // 整数部分は3桁以内、少数部分は1桁以内の数字を許可する
        // ①空か②0じゃないか③999.9より小さいか④0の後に数字がこないか⑤小数値が2個以上続かないか
        var repVal= $(".form-rep").val();
        var repValidationError = repVal == "" || /^0/.test(repVal)　|| repVal > 99 || /[/.]/.test(repVal);
        //  少数を許さない整数2桁以内

        if( weightValidationError == true || repValidationError == true ){
            addBtn.prop("disabled", true);
        } else {
            addBtn.prop("disabled", false);
        }
    });
}

function programMemoValidation(){

    $('.remodal-memo').on('keyup', function(){
        var addBtn = $(".store-program-btn");

        var memoVal = $(".remodal-memo").val();
        var memoValidationError = memoVal.length > 100;
        // ①100文字以内

        if( memoValidationError == true ){
            addBtn.prop("disabled", true);
        } else {
            addBtn.prop("disabled", false);
        }
    });

}
