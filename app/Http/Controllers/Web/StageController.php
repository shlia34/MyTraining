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
