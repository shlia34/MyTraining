<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Training;

class TrainingController extends Controller
{

    //todo アクション側でバリデーションをかける

    public function storeTraining(Request $request){

        $data = $request->all();
        $training = new Training();
        $training->training_id = $this->generateId('TR');
        $training->event_id = $data['event_id'];
        $training->stage_id = $data['stage_id'];
        $training->weight = $data['weight'];
        $training->rep = $data['rep'];
        $training->is_max = false;
        $training->save();

        $returnData =  ['training_id'=>$training->training_id,
                        'stage_id'=>$training->stage_id,
                        'stage_name'=>$training->getStageName() ];

        return response()->json($returnData);
    }

    public function recordMaxTraining(Request $request){

        $eventId = $request->all()["event_id"];
        $trainings = Training::where("event_id", $eventId)->where("is_max", 1)->get();
        foreach ($trainings as $training){
            $training->is_max = 0;
            $training->save();
        }
        //一旦消す。二個以上ないはずだけど一応foreach。

        $trainingId = $request->all()["training_id"];
        $training = Training::find($trainingId);
        $training->is_max = true;
        $training->save();

        return null;
    }

    //todo trueかfalseにしたい
    public function checkMaxTraining(Request $request){
        $training = Training::find($request->all()["training_id"]);

        if( $training->is_max == 0){
                $message = false;
        } else{
            $message = true;
        }

        return response()->json($message);
    }

    public function deleteMaxTraining(Request $request){
        $training = Training::find($request->all()["training_id"]);
        $training->is_max = 0;
        $training->save();

        return response()->json("ok");
    }

    public function deleteTraining(Request $request){

        $training_id = $request->all()["training_id"];
        $training = Training::find($training_id);
        $training->delete();

        return null;
    }

}
