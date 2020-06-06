<?php

namespace App\Http\Controllers\Web;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    /**
     * カレンダー表示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('program.index');
    }

    /**
     * イベントの詳細ページ。前回のイベントも取得する
     * @param $programId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $programId)
    {
        //todo findorfailsにしなきゃ

        //todo これどうやってmenuをsortすんねん
        $thisProgram = Program::where('id', $programId)->with(['menus.workouts'])->first();
        $previousProgram = Program::where('muscle_code',$thisProgram->muscle_code)->Own()->whereDate("date", "<", $thisProgram->date)->latest("date")->with(['menus.workouts'])->first();

        $exerciseArray = Auth::user()->exercises()->where('muscle_code',$thisProgram->muscle_code)->orderBy('pivot_sort_no')->get()->pluck('name', 'id');

        return view('program.show')->with(['thisProgram' => $thisProgram, 'previousProgram' => $previousProgram, 'exerciseArr' =>$exerciseArray ]);
    }

    /**
     * イベントと、それに紐づくトレーニングを削除
     * @param $programId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(string $programId)
    {
        $program = Program::find($programId);
        $program->delete();

        return redirect("/");
    }

}
