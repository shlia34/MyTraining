<?php

namespace App\Http\Controllers\Api;

use App\Models\Choice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChoiceController extends Controller
{
    /**
     * storeする時の臨時の値
     */
    const DEFAULT_SORT_NO = 00;


    public function store(Request $request)
    {
        $insertData = $request->only('stage_id')
                    + ['user_id' => Auth::user()->user_id]
                    + ['sort_no' => self::DEFAULT_SORT_NO];

        Choice::create($insertData);

        return null;
    }

    public function destroy(Request $request)
    {
        $stageId = $request->only("stage_id");
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
