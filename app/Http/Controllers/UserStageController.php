<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\UserStage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserStageController extends Controller
{
    public function store(Request $request)
    {
        $stageId = $request->all()["stage_id"];
        $stage = Stage::find($stageId);


        $userStage = new UserStage();
        $userStage->user_id = Auth::user()->user_id;
        $userStage->stage_id = $stageId;
        $userStage->sort_no =  $this->generateSortNo($stage->part_code);
        $userStage->save();

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
            'sort_no'=>$userStage->sort_no,
            ];

        return response()->json($returnData);

    }

    public function delete(){
//        return view('top.admin');
    }

    public function generateSortNo($partCode)
    {
        $lastStage = Auth::user()->stages()->where("part_code",$partCode)->orderBy('sort_no','desc')->first();


        if ($lastStage) {
            $lastSortId = $lastStage->pivot->sort_no;
            return $lastSortId + 1;
        } else {
            return 1;
        }
    }
}
