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

        $choice = new Choice();
        $choice->user_id = Auth::user()->user_id;
        $choice->stage_id = $stageId;
        $choice->sort_no =  000;
        //一旦入れとく
        $choice->save();

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
        ];

        return response()->json($returnData);
    }

    public function destroy(Request $request)
    {
        $stageId = $request->all()["stage_id"];
        $stage = Stage::find($stageId);
        $choice = Choice::where('stage_id',$stageId)->own()->first();
        $choice->delete();

        $returnData =  [
            'stage_id' => $stageId,
            'stage_name'=>$stage->name,
            'part_code'=>$stage->part_code,
        ];

        return response()->json($returnData);
    }

    public function sort(Request $request)
    {
        $stageIds =  $request["stage_ids"] ?? [];
        foreach ($stageIds as $i => $stageId){
            $choice = Choice::where('stage_id',$stageId)->own()->first();
            $choice->sort_no = $i;
            $choice->save();
        }
        return null;
    }
}
