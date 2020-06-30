<?php

namespace App\Http\Controllers\Api;

use App\Models\Routine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoutineController extends Controller
{
    /**
     * storeする時の臨時の値
     */
    const DEFAULT_SORT_NO = 00;


    /**
     * 保存
     * @param Request $request
     * @return |null
     */
    public function store(Request $request)
    {
        $insertData = $request->only('exercise_id')
                    + ['id' => $this->generateId('RO')]
                    + ['user_id' => Auth::user()->id]
                    + ['sort_no' => self::DEFAULT_SORT_NO];

        Routine::create($insertData);

        return null;
    }

    /**
     * 削除
     * @param Request $request
     * @return |null
     */
    public function delete($exerciseId)
    {
        $routine = Routine::whereExercise($exerciseId)->own()->first();
        $routine->delete();
        return null;
    }

    /**
     * 並び替え
     * @param Request $request
     * @return |null
     */
    public function sort(Request $request)
    {
        $exerciseIds =  $request["exercise_ids"] ?? [];
        foreach ($exerciseIds as $index => $exerciseId){
            $routine = Routine::whereExercise($exerciseId)->own()->first();
            $routine->sort_no = $index;
            $routine->save();
        }
        return null;
    }
}
