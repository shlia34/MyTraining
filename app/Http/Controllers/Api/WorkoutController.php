<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Workout\Workout as WorkoutResource;
use App\Http\Request\Api\Workout\StoreRequest;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Program;
use App\Models\Menu;

class WorkoutController extends Controller
{
    /**
     * 保存
     * @param Request $request
     */
    public function store(StoreRequest $request)
    {
        $program = Program::find($request['program_id']);
        $menu = $program->menus()->where('exercise_id',$request['exercise_id'])->first();

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

        return new WorkoutResource($workout);
    }

    /**
     * 削除
     * @param Request $request
     * @return |null
     */
    public function destroy(Request $request)
    {
        $id = $request->all()["workout_id"];
        $workout = Workout::find($id);
        $workout->delete();

        //もしmenuに所属するworkoutが存在しなくなったら削除
        $menu = $workout->menu;
        if($menu->workouts->count() === 0){
            $menu->delete();
        }

        return null;
    }

    /**
     * 最大強度に登録する
     * @param Request $request
     * @return |null
     */
    public function OnMax(Request $request)
    {
        $program =  Program::find($request->all()["program_id"]);
        $workouts = $program->workouts()->where("is_max", 1)->get();
        foreach ($workouts as $workout){
            $workout->is_max = 0;
            $workout->save();
        }
        //一旦消す。二個以上ないはずだけど一応foreach。
        $workoutId = $request->all()["workout_id"];
        $workout = Workout::find($workoutId);
        $workout->is_max = 1;
        $workout->save();

        return null;
    }

    /**
     * 最大強度の登録を外す
     * @param Request $request
     * @return |null
     */
    public function OffMax(Request $request)
    {
        $workout = Workout::find($request->all()["workout_id"]);
        $workout->is_max = 0;
        $workout->save();

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
