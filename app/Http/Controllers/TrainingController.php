<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Training;

class TrainingController extends Controller
{

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


    //todo 動いてるけど、training削除したあとエラー起きてる
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

}
