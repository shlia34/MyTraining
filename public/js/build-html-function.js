//以下event
/**
 * イベント詳細のリンクのhtml作成
 * @param value
 * @returns {string}
 */
function buildLinksEventHtml(value) {
    var html =`<li><a href='/events/${value["id"]}'>${value["title"]}</a>${value["stage_name"]} ${value["weight_and_rep"]}</li>`;
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
function buildTrainingHtml(result,weight,rep)
{
    var html = `<li data-training_id = ${result['training_id']} class = "this-training">${weight}kg * ${rep}rep`;
    return html;
}

/**
 * 新たな種目のトレーニングが追加された場合に種目カードのhtml作成
 * @param result
 * @returns {string}
 */
function buildStageCardHtml(result) {
    var html = `<div class="card mt-2 mb-2 mr-2 ml-2 p-2">
                    <span class="mb-0">
                        <a class = "card-title" href ="/stages/${result["stage_id"]}">${result["stage_name"]}</a>
                    </span>
                    <ol data-stage_id=${result["stage_id"]} class="ol-training mb-0"></ol>
                </div>`;
    return html;
}
