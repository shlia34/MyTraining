<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;

class TrainingController extends Controller
{
    //todo formRequest作る
    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $insertData = $request->only('event_id','stage_id','weight','rep')
                    + ['training_id' => $this->generateId('TR')]
                    + ['is_max' => 0];

        $training = Workout::create($insertData);

        $returnData =  ['training_id'=>$training->training_id,
                        'stage_id'=>$training->stage_id,
                        'stage_name'=>$training->stage_name ];

        return response()->json($returnData);
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
        $training = Workout::find($request->all()["training_id"]);
        $training->is_max == 0 ? $message = false : $message = true;

        return response()->json($message);
    }

}
