<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Training;
use App\Models\Stage;
use App\Models\UserStage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserStageController extends Controller
{
    public function store(Request $request)
    {



        //今度変更して、一個ずつにする。んでajaｘでやる。
       //あるやつ全削除

        $stageIds = $request->all()["stageIds"];

        foreach ($stageIds as $stageId){
            $userStage = new UserStage();
            $userStage->user_id = Auth::user()->user_id;
            $userStage->stage_id = $stageId;
//        $partCode =
//        stagecodeからpartcodeを取得してくる
            $userStage->sort_no =  $this->generateSortNum("test");
            $userStage->save();
        }


        return redirect("/stage/index");
    }

    public function delete(){
//        return view('top.admin');
    }

    public function generateSortNum($partCode){
//        if($lastStage = Stage::where('part_code', $partCode)->orderBy('sort_no','desc')->first()){
//            $lastSortId = $lastStage->sort_num;
//            return $lastSortId + 1;
//        }else{
            return 1;
        }
}
