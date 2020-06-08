<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Request\Web\Stage\StoreRequest;
use App\Models\Exercise;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{

    /**
     * 一覧画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //todo vueで書くときにbyPart()をなんとかする
        //todo routineとnotRoutineを別の変数で受け取る?
        $exerciseByMuscle  = Auth::user()->exercises()->byMuscle();
        $firstMuscleCode =  $request->all()["muscleCode"] ?? "01";

        return view("exercise.index")->with(['exerciseByMuscle' => $exerciseByMuscle,'firstMuscleCode'=>$firstMuscleCode]);
    }

    /**
     * 種目の詳細画面、種目に紐づいたmenu,workoutも表示する
     * @param Request $request
     * @param $stageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($exerciseId)
    {
        $exercise = Exercise::findOrFail($exerciseId);
        $menus = $exercise->menus()->latest('date')->own()->with(['workouts'])->paginate();

        return view("exercise.show")->with([ 'exercise' => $exercise, 'menus' => $menus]);
    }

    /**
     * 追加画面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("exercise.create");
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

        return redirect(route('exercise.index', ['muscleCode' => $request->all()["muscle_code"] ]));
    }

}
