<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Training;
use App\Defs\DefStage;

class TrainingController extends Controller
{

    public function getTrainingFromId($id)
    {
        return Training::find($id);
    }

    public function revertStageName($stageCode){
        return array_column(DefStage::STAGE_LIST, $stageCode);

    }

    public function storeTraining(Request $request){



        $data = $request->all();
        $training = new Training();
        $training->training_id = $this->generateId('TR');
        $training->event_id = $data['event_id'];
        $training->stage_code = $data['stage_code'];
        $training->weight = $data['weight'];
        $training->rep = $data['rep'];

        \Log::debug($data['event_id']);

        $training->save();

        $returnData =  ['training_id'=>$training->training_id,
                        'stage_name'=>$this->revertStageName($data['stage_code'])];

        return response()->json($returnData);

    }

    public function recordMaxTraining(Request $request){

        $event_id = $request->all()["event_id"];
        $training_id = $request->all()["training_id"];




        $event = Event::find($event_id);
        $event->max_training_id = $training_id;
        $event->save();
//        $training = $this->getTrainingFromId($training_id);
//        $training->delete();

        return null;
    }

    public function deleteTraining(Request $request){

        $training_id = $request->all()["training_id"];
        $training = $this->getTrainingFromId($training_id);
        $training->delete();

        return null;
    }


}