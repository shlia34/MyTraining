$(function()
{
    storeWorkout();
    showModalWorkout();
});

/**
 * トレーニングを追加
 */
function storeWorkout()
{
    $(".add-workout-btn").on("click",function () {
        var program_id = $(".this-program-show").data('program_id');
        var exercise_id_val = $(".form-exercise_id").val();
        var weight_val = $(".form-weight").val();
        var rep_val = $(".form-rep").val();

        var data = {
            "program_id":program_id,
            "exercise_id":exercise_id_val,
            "weight":weight_val,
            "rep":rep_val
        };

        apiStoreWorkout(data,function(result){
            var menu_id = result['menu_id'];

            var ol_menu = $(`.this-workouts .card ol[data-menu_id=${menu_id}]`);

            if(!ol_menu.is(':visible')){
                $(".this-workouts").append(buildMenuCardHtml(result));
            }

            var menu_card = $(`.this-workouts .card ol[data-menu_id=${menu_id}]`);
            menu_card.append(buildWorkoutHtml(result));

        });
    })

}

/**
 * トレーニングクリック時のモーダルを表示
 */
function showModalWorkout()
{
    var data = {};

    var falseRemodal = $('[data-remodal-id=false-workout-remodal]').remodal();
    var trueRemodal = $('[data-remodal-id=true-workout-remodal]').remodal();


    $(document).on("click", ".this-workout", function () {

        data = {
            "program_id"   : $(".this-program-show").data('program_id'),
            "workout_id": $(this).data('workout_id'),
            "menu_id": $(this).parent().data('menu_id'),
        };

        apiCheckMaxWorkout(data,function(result){
            if(result === false){
                falseRemodal.open();
            }else if(result === true){
                trueRemodal.open();
            }
        });
    });

    $(document).on("click", ".delete-workout-btn", function () {
        destroyWorkout(data);
        falseRemodal.close();
    });

    $(document).on("click", ".on-max-workout-btn", function () {
        onMaxWorkout(data);
        falseRemodal.close();
    });

    $(document).on("click", ".off-max-workout-btn", function () {
        offMaxWorkout(data);
        trueRemodal.close();
    });
}

/**
 * トレーニング削除
 * @param data
 */
function destroyWorkout(data)
{
    var workout_box = $(`.this-workout[data-workout_id=${data.workout_id}]`);
    var menu_id = data.menu_id;

    apiDestroyWorkout(data,function(){
        workout_box.remove();
        var menu_card = $(`.this-workouts .card ol[data-menu_id=${menu_id}]`);
        if(!menu_card.find('li').is(':visible')){
            menu_card.parent().remove();
        }
    });
}

/**
 * 最大強度に登録して、アンダーバーをつける
 * @param data
 */
function onMaxWorkout(data)
{
    var workout_box = $(`.this-workouts .this-workout[data-workout_id=${data.workout_id}]`);

    apiOnMaxWorkout(data,function(){
        $('.this-workouts ._add-underline').removeClass("_add-underline");
        workout_box.addClass("_add-underline");
    });
}

/**
 * 最大強度の登録を外して、アンダーバー消す
 * @param data
 */
function offMaxWorkout(data)
{
    apiOffMaxWorkout(data,function(){
        $('.this-workouts ._add-underline').removeClass("_add-underline");
    });

}

