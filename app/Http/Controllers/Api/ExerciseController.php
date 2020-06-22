<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Request\Api\Exercise\StoreRequest;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExerciseController extends Controller
{
    public function routine($muscleCode)
    {
        $exercises = Auth::user()->exercises()->where('muscle_code',$muscleCode)->orderBy('pivot_sort_no')->get();
        return response()->json($exercises);
    }

    public function notRoutine($muscleCode)
    {
        $notRoutines = Exercise::where('muscle_code',$muscleCode)->get()->diff(Auth::user()->exercises);
        return response()->json($notRoutines);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $exercise = Exercise::findOrFail($id);
        $menus = $exercise->menus()->latest('date')->own()->with(['workouts'])->paginate();

        return response()->json([ 'exercise' => $exercise, 'menus' => $menus]);
    }

    /**
     * 追加処理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $insertData = $request->only('name','muscle_code')
            + ['id' => $this->generateId('EX') ];

        Exercise::create($insertData);

        return null;
    }

}
