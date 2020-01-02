<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Training;

class TrainingController extends Controller
{

    //todo アクション側でバリデーションをかける

    public function storeTraining(Request $request){

        $data = $request->all();
        $training = new Training();
        $training->training_id = $this->generateId('TR');
        $training->event_id = $data['event_id'];
        $training->stage_code = $data['stage_code'];
        $training->weight = $data['weight'];
        $training->rep = $data['rep'];

        $training->save();

        $returnData =  ['training_id'=>$training->training_id,
                        'stage_name'=>$training->getStageName() ];

        return response()->json($returnData);
    }

    public function recordMaxTraining(Request $request){

        $event_id = $request->all()["event_id"];
        $training_id = $request->all()["training_id"];

        $event = Event::find($event_id);
        $event->max_training_id = $training_id;
        $event->save();

        return null;
    }

    public function deleteTraining(Request $request){

        $training_id = $request->all()["training_id"];
        $training = Training::find($training_id);
        $training->delete();

        return null;
    }


}