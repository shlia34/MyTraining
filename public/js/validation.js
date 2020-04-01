$(function()
{
    weightAndRepValidation();
    memoValidation();
});


function weightAndRepValidation()
{
    $(".form-weight,.form-rep").on('keyup', function(){
        var add_btn = $(".add-training-btn");

        var weight_val= $(".form-weight").val();
        var weight_validation_error = weight_val == "" || /^0/.test(weight_val)　|| weight_val > 1000 || /[/.][0-9]{2,}/.test(weight_val);
        // 整数部分は3桁以内、少数部分は1桁以内の数字を許可する
        // ①空か②0から始まらないか③整数部分は3桁以内か④小数値が2個以上続かないか
        var rep_val= $(".form-rep").val();
        var rep_validation_error = rep_val == "" || /^0/.test(rep_val)　|| rep_val > 100 || /[/.]/.test(rep_val);
        //  少数を許さない整数2桁以内
        //todo val()ではピリオドが取得できない。「11.」を「11」として取得してしまうので困ってる。(スマホではなんか大丈夫)

        if( weight_validation_error == true || rep_validation_error == true ){
            add_btn.prop("disabled", true);
        } else {
            add_btn.prop("disabled", false);
        }
    });
}

function memoValidation(){

    $('.remodal-memo').on('keyup', function(){
        var add_btn = $(".store-event-btn");

        var memo_val = $(".remodal-memo").val();
        var memo_validation_error = memo_val.length > 100;
        // ①100文字以内

        if( memo_validation_error == true ){
            add_btn.prop("disabled", true);
        } else {
            add_btn.prop("disabled", false);
        }
    });

}
