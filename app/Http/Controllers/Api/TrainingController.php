<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Workout as WorkoutResource;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Program;
use App\Models\Menu;

class TrainingController extends Controller
{
    //todo formRequest作る
    /**
     * 保存
     * @param Request $request
     */
    public function store(Request $request)
    {
        $program = Program::find($request['program_id']);
        $menu = $program->menus()->where('exercise_id',$request['exercise_id'])->first();

        //todo トランザクション機能を使ってみる
        if($menu === null){
            $menuInsertData = $request->only('exercise_id','program_id')
                            + ['id' => $this->generateId('ME')];

            $menu = Menu::create($menuInsertData);
        }

        $workoutInsertData = $request->only('weight','rep')
                            + ['id' => $this->generateId('WO')]
                            + ['menu_id' => $menu->id]
                            + ['is_max' => 0];

        $workout = Workout::create($workoutInsertData);
        //todo ここまで

        return new WorkoutResource($workout);
    }

    /**
     * 削除
     * @param Request $request
     * @return |null
     */
    public function destroy(Request $request)
    {
        $training_id = $request->all()["training_id"];
        $training = Workout::find($training_id);
        $training->delete();

        return null;
    }

    /**
     * 最大強度に登録する
     * @param Request $request
     * @return |null
     */
    public function OnMax(Request $request)
    {
        $eventId = $request->all()["event_id"];
        $trainings = Workout::where("event_id", $eventId)->where("is_max", 1)->get();
        foreach ($trainings as $training){
            $training->is_max = 0;
            $training->save();
        }
        //一旦消す。二個以上ないはずだけど一応foreach。
        $trainingId = $request->all()["training_id"];
        $training = Workout::find($trainingId);
        $training->is_max = 1;
        $training->save();

        return null;
    }

    /**
     * 最大強度の登録を外す
     * @param Request $request
     * @return |null
     */
    public function OffMax(Request $request)
    {
        $training = Workout::find($request->all()["training_id"]);
        $training->is_max = 0;
        $training->save();

        return null;
    }

    /**
     * trainingが最大強度の登録されているか判別する
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * falseかtrueを返す
     */
    public function checkMax(Request $request)
    {
        $training = Workout::find($request->all()["workout_id"]);
        $training->is_max == 0 ? $message = false : $message = true;

        return response()->json($message);
    }

}
