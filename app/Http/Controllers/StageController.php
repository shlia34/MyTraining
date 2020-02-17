<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;

class StageController extends Controller
{
    public function index(){
        //種目の一覧画面
        $stages = Stage::orderBy('sort_num')->get()->groupBy('part_code');
        return view("stage.index")->with([ 'stages' => $stages]);
    }

    public function show($stageId){
        //todo 404処理
        $stage = Stage::find($stageId);
        //種目の追加画面
        return view("stage.show")->with([ 'stage' => $stage]);
    }

    public function create(){
        //種目の追加画面


        return view("stage.create");
    }

    public function store(Request $request){
        //種目の追加処理
        $data = $request->all();

        $stage = new Stage;
        $stage->stage_id = $this->generateId('ST');
        $stage->name = $data["name"];
        $stage->part_code = $data["part_code"];
        $stage->pof_code = $data["pof_code"];
        $stage->sort_num = $this->generateSortNum($data["part_code"]);
        $stage->memo = $data["memo"];
        $stage->save();

        return redirect("/stage/create");
    }

    public function edit(){
        //種目の編集画面
        return view("stage.edit");
    }

    public function update(){
        //種目の編集処理
//        return redirect("/stage/show");
    }

    public function generateSortNum($partCode){
        if($lastStage = Stage::where('part_code', $partCode)->orderBy('sort_num','desc')->first()){
            $lastSortId = $lastStage->sort_num;
            return $lastSortId + 1;
        }else{
            return 1;
        }
    }





}