<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;

class StageController extends Controller
{

    public function index(){
        //todo これ考えものだな
        $userStages = (new Stage)->getUserStage();
        $leftStages = (new Stage)->getLeftStage();
        return view("stage.index")->with([ 'userStages' => $userStages, 'leftStages' => $leftStages]);
    }

    public function show($stageId){
        $stage = Stage::findOrFail($stageId);
        $trainings = $stage->trainings()->joinEvent()->orderBy('created_at')->own()->get()->groupBy('date')->sortKeysDesc();

        return view("stage.show")->with([ 'stage' => $stage, 'trainings'=>$trainings ]);
    }

    public function create(){
        return view("stage.create");
    }

    public function store(Request $request){
        $data = $request->all();

        $stage = new Stage;
        $stage->stage_id = $this->generateId('ST');
        $stage->name = $data["name"];
        $stage->part_code = $data["part_code"];
        $stage->pof_code = $data["pof_code"];
        $stage->memo = $data["memo"];
        $stage->save();

        return redirect("/stage/create");
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
