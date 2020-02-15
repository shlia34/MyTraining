<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;

class StageController extends Controller
{
    //todo シンプルなcrudでいいかな
    //deleteはいらんかな

    public function index(){
        //種目の一覧画面
        $stages = Stage::all();

        return view("stage.index")->with([ 'stages' => $stages]);
    }

    public function show(){
        //種目の追加画面
        return view("stage.show");
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

        return redirect("/stage/index");
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