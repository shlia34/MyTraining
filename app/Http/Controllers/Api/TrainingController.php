<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{

    //todo formRequest作る
    public function store(Request $request){

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

    public function destroy(Request $request){

        $training_id = $request->all()["training_id"];
        $training = Training::find($training_id);
        $training->delete();

        return null;
    }



}
