<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Stage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StageController extends Controller
{
    public function index(Request $request)
    {
        $stagesByPart  = Auth::user()->stages()->byPart();
        $firstPartCode =  $request->all()["partCode"] ?? "01";
        //formRequestでここの処理やってもいいかも

        return view("stage.index")->with(['stagesByPart' => $stagesByPart,'firstPartCode'=>$firstPartCode]);
    }

    public function show(Request $request,$stageId)
    {
        $stage = Stage::findOrFail($stageId);
        $paginatorTrainings = $stage->trainings()->paginator($request,$stageId);

        return view("stage.show")->with([ 'stage' => $stage, 'trainings'=>$paginatorTrainings ]);
    }

    public function create()
    {
        return view("stage.create");
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $stage = new Stage;
        $stage->stage_id = $this->generateId('ST');
        $stage->name = $data["name"];
        $stage->part_code = $data["part_code"];
        $stage->pof_code = $data["pof_code"];
        $stage->memo = $data["memo"];
        $stage->save();

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
