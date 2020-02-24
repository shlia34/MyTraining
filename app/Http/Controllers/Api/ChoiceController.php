<?php

namespace App\Http\Controllers\Api;

use App\Models\Stage;
use App\Models\Choice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChoiceController extends Controller
{

    public function store(Request $request)
    {
        $stageId = $request->all()["stage_id"];
        $stage = Stage::find($stageId);
        //todo もし、もうあった場合、エラー出す

        $stageList = new Choice();
        $stageList->user_id = Auth::user()->user_id;
        $stageList->stage_id = $stageId;
        $stageList->sort_no =  $stageList->generateSortNo($stage->part_code);
        $stageList->save();

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
            'sort_no'=>$stageList->sort_no,
        ];

        return response()->json($returnData);

    }

    public function destroy(Request $request){
        $stageId = $request->all()["stage_id"];
        $stage = Stage::find($stageId);
        $stageUser = Choice::where('stage_id',$stageId)->where('user_id',Auth::user()->user_id)->first();
        $stageUser->delete();
        //todo もし、なかった場合、エラー出す

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
        ];

        return response()->json($returnData);
    }

}
