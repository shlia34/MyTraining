<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Request\Web\Exercise\StoreRequest;
use App\Models\Exercise;
use App\Http\Controllers\Controller;

class ExerciseController extends Controller
{

    /**
     * 一覧画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $firstMuscleCode =  $request->all()["muscleCode"] ?? "01";

        return view("exercise.index")->with(['firstMuscleCode'=>$firstMuscleCode]);
    }

    /**
     * 種目の詳細画面
     * @param Request $request
     * @param $stageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($exerciseId,Request $request)
    {
        $page =  $request->all()['page'] ?? 1;
        return view("exercise.show")->with(['exerciseId' => $exerciseId, 'page'=>$page]);
    }


}
