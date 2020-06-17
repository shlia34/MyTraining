<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExerciseController extends Controller
{

    public function indexRoutine(Request $request){
        $muscleCode = $request->all()['muscleCode'];
        $exercises = Auth::user()->exercises()->where('muscle_code',$muscleCode)->orderBy('pivot_sort_no')->get();

        return response()->json(['exercises' => $exercises]);
    }

}
