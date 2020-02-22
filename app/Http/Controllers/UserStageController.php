<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\UserStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserStageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $stageId = $request->all()["stage_id"];
        $stage = Stage::find($stageId);
        //todo もし、もうあった場合、エラー出す

        $stageList = new UserStage();
        $stageList->user_id = Auth::user()->user_id;
        $stageList->stage_id = $stageId;
        $stageList->sort_no =  $this->generateSortNo($stage->part_code);
        $stageList->save();

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
            'sort_no'=>$stageList->sort_no,
        ];

        return response()->json($returnData);

    }

    public function delete(Request $request){
        $stageId = $request->all()["stage_id"];
        $stage = Stage::find($stageId);
        $stageUser = UserStage::where('stage_id',$stageId)->where('user_id',Auth::user()->user_id)->first();
        \Log::debug($stageUser);
        $stageUser->delete();

        //削除処理

        //todo もし、なかった場合、エラー出す

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
        ];

        return response()->json($returnData);
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
