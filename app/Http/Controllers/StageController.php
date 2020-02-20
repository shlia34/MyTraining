<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;


class StageController extends Controller
{
    public function index(){
        //種目の一覧画面
        $userStageList = Auth::user()->stages->groupBy('part_code')->sortKeys();
        $leftStages = Stage::all()->diff(Auth::user()->stages)->groupBy('part_code')->sortKeys();
        return view("stage.index")->with([  'userStages' => $userStageList, 'leftStages' => $leftStages]);
    }

    public function show($stageId){
        $stage = Stage::findOrFail($stageId);
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

}
