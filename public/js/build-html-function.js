//以下training
/**
 * トレーニング追加時のhtml作成
 * @param result
 * @param weight
 * @param rep
 * @returns {string}
 */
function buildWorkoutHtml(result)
{
    var html = `<li data-workout_id = ${result['id']} class = "this-workout">${result['weight_and_rep']}`;
    return html;
}

/**
 * 新たな種目のトレーニングが追加された場合に種目カードのhtml作成
 * @param result
 * @returns {string}
 */
function buildMenuCardHtml(result) {
    var html = `<div class="card mt-2 mb-2 mr-2 ml-2 p-2">
                    <span class="mb-0">
                        <a class = "card-title" href ="/exercises/${result["exercise_id"]}">${result["exercise_name"]}</a>
                    </span>
                    <ol data-menu_id=${result["menu_id"]} class="ol-workout mb-0"></ol>
                </div>`;
    return html;
}
