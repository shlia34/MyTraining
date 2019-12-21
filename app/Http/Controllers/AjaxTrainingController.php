<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Training;
use Illuminate\Support\Arr;
use App\Defs\DefStage;

class AjaxTrainingController extends Controller
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

        $training->save();

        $stageName = $this->revertStageName($data['stage_code']);

        return response()->json($stageName);

    }


}