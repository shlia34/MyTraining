//以下event
function buildLinksEventHtml(value) {
    var html ="<li>" + "<a href='/event/" + value["id"] + "'>"+ value["title"] +"</a>"+ value["stage_name"] + value["weight_and_rep"] +"</li>";
    return html;
}
//以下training
function buildTrainingHtml(result,weight,rep)
{
    var html = `<li data-training_id = ${result['training_id']} class = "this-training">${weight}kg * ${rep}rep`;
    return html;
}

function buildStageCardHtml(result) {
    var html = `<div class="card mt-2 mb-2 mr-2 ml-2 p-2"><span class="card-title mb-0">${result["stage_name"]}</span><ol data-stage_id=${result["stage_id"]} class="ol-training mb-0"></div>`;
    return html;
}
//以下trainings.is_max
function buildTrainingModalHtml(result)
{
    if(result === false){
        var html = `<button class="delete-training-btn">削除</button><button class="on-max-training-btn">マックスに登録</button>`;
    }else if(result === true){
        html = `<button class="off-max-training-btn">マックスをオフ</button>`;
    }
    return html;
}
//以下choice
function buildStoreChoiceHtml(result) {
    var html = `<div class ="" data-stage_id= ${result['stage_id']} ><a href= "/stage/${result['stage_id']}">${result['stage_name']}</a>`;
    html += "<a class=\"stage-user-delete-btn\">削除</a></div>";
    return html;
}

function buildDestroyChoiceHtml(result) {
    var html = `<div class ="" data-stage_id= ${result['stage_id']}><a href= "/stage/${result['stage_id']}">${result['stage_name']}</a>`;
    html += "<a class=\"stage-user-store-btn\">追加</a></div>";
    return html;
}