<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Request\Web\Stage\StoreRequest;
use App\Models\Stage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StageController extends Controller
{
    /**
     * 一覧画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $stagesByPart  = Auth::user()->stages()->byPart();
        $firstPartCode =  $request->all()["partCode"] ?? "01";

        return view("stage.index")->with(['stagesByPart' => $stagesByPart,'firstPartCode'=>$firstPartCode]);
    }

    /**
     * 種目の詳細画面、種目に紐づいたトレーニングも表示する
     * @param Request $request
     * @param $stageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request,$stageId)
    {
        $stage = Stage::findOrFail($stageId);
        $paginatorTrainings = $stage->trainings()->paginator($request,$stageId);

        return view("stage.show")->with([ 'stage' => $stage, 'trainings'=>$paginatorTrainings ]);
    }

    /**
     * 追加画面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("stage.create");
    }

    /**
     * 追加処理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $insertData = $request->only('name','part_code','pof_code','memo')
                    + ['stage_id' => $this->generateId('ST') ];

        Stage::create($insertData);

        return redirect("/stages/create");
    }

//    public function edit(){
//        return view("stage.edit");
//    }

//    public function update(){
//        種目の編集処理
//        adminしかできないようにする？？
//        return redirect("/stage/show");
//    }

}
