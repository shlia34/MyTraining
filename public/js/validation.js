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
        var weightValidationError = weightVal == "" || /^0/.test(weightVal)　|| weightVal > 1000 || /[/.][0-9]{2,}/.test(weightVal);
        // 整数部分は3桁以内、少数部分は1桁以内の数字を許可する
        // ①空か②0から始まらないか③整数部分は3桁以内か④小数値が2個以上続かないか
        var repVal= $(".form-rep").val();
        var repValidationError = repVal == "" || /^0/.test(repVal)　|| repVal > 100 || /[/.]/.test(repVal);
        //  少数を許さない整数2桁以内
        //todo val()ではピリオドが取得できない。「11.」を「11」として取得してしまうので困ってる。(スマホではなんか大丈夫)

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
