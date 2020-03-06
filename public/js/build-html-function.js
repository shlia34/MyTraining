//以下event
function buildLinksEventHtml(value) {
    var html =`<li><a href='/events/${value["id"]}'>${value["title"]}</a>${value["stage_name"]} ${value["weight_and_rep"]}</li>`;
    return html;
}
//以下training
function buildTrainingHtml(result,weight,rep)
{
    var html = `<li data-training_id = ${result['training_id']} class = "this-training">${weight}kg * ${rep}rep`;
    return html;
}

function buildStageCardHtml(result) {
    var html = `<div class="card mt-2 mb-2 mr-2 ml-2 p-2">
                    <span class="mb-0">
                        <a class = "card-title" href ="/stages/${result["stage_id"]}">${result["stage_name"]}</a>
                    </span>
                    <ol data-stage_id=${result["stage_id"]} class="ol-training mb-0"></ol>
                </div>`;
    return html;
}
//以下trainings.is_max
function buildTrainingModalHtml(result)
{
    if(result === false){
        var html = `<button class="remodal-btn on-max-training-btn">マックスに登録</button><button class="remodal-btn delete-training-btn">削除</button>`;
    }else if(result === true){
        html = `<button class="remodal-btn off-max-training-btn">マックスをオフ</button>`;
    }
    return html;
}