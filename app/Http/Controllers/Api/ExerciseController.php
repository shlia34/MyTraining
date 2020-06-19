<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExerciseController extends Controller
{

    public function index(Request $request){
        $muscleCode =  $request->all()['muscle_code'];
        $routines = Auth::user()->exercises()->where('muscle_code',$muscleCode)->orderBy("sort_no")->get();
        $notRoutines = Exercise::where('muscle_code',$muscleCode)->get()->diff(Auth::user()->exercises);

        return response()->json(['routines'=>$routines,'notRoutines'=>$notRoutines]);
    }

    //todo 上のと処理一緒やん。
    public function indexRoutine(Request $request){
        $muscleCode = $request->all()['muscleCode'];
        $exercises = Auth::user()->exercises()->where('muscle_code',$muscleCode)->orderBy('pivot_sort_no')->get();

        return response()->json(['exercises' => $exercises]);
    }

    public function show($exerciseId,Request $request){
        $exercise = Exercise::findOrFail($exerciseId);
        $menus = $exercise->menus()->latest('date')->own()->with(['workouts'])->paginate();

        return response()->json([ 'exercise' => $exercise, 'menus' => $menus]);
    }

}
