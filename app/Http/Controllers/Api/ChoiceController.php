<?php

namespace App\Http\Controllers\Api;

use App\Models\Choice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChoiceController extends Controller
{
    const DEFAULT_SORT_NO = 00;

    public function store(Request $request)
    {
        $choice = new Choice();
        $choice->user_id = Auth::user()->user_id;
        $choice->stage_id = $request->all()["stage_id"];
        $choice->sort_no = self::DEFAULT_SORT_NO;
        $choice->save();

        return null;
    }

    public function destroy(Request $request)
    {
        $stageId = $request->all()["stage_id"];
        $choice = Choice::whereStage($stageId)->own()->first();
        $choice->delete();

        return null;
    }

    public function sort(Request $request)
    {
        $stageIds =  $request["stage_ids"] ?? [];
        foreach ($stageIds as $index => $stageId){
                $choice = Choice::whereStage($stageId)->own()->first();
                $choice->sort_no = $index;
                $choice->save();
        }
        return null;
    }
}
