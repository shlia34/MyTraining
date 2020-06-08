//以下event
/**
 * イベント詳細のリンクのhtml作成
 * @param value
 * @returns {string}
 */
function buildLinksEventHtml(value) {
    var html =`<li><a href='/programs/${value["id"]}'>${value["title"]}</a>`;
    if(value["maxWorkout"] !== null){
        html += `${value["maxWorkout"]["exercise_name"]} ${value["maxWorkout"]["weightAndRep"]}</li>`;
    }

    return html;
}
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
    var html = `<li data-workout_id = ${result['id']} class = "this-training">${result['weightAndRep']}`;
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
                    <ol data-menu_id=${result["menu_id"]} class="ol-training mb-0"></ol>
                </div>`;
    return html;
}
