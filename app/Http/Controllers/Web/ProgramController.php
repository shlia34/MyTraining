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
     * 詳細ページ。前回のprogramも取得する
     * @param $programId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $programId)
    {
        $thisProgram = Program::where('id', $programId)->with(['menus.workouts'])->first() ?? abort(404);
        $previousProgram = Program::previous($thisProgram)->with(['menus.workouts'])->first();

        $exercises = Auth::user()->exercises()->where('muscle_code',$thisProgram->muscle_code)->orderBy('pivot_sort_no')->get();

        return view('program.show')->with(['thisProgram' => $thisProgram, 'previousProgram' => $previousProgram, 'exercises' =>$exercises ]);
    }

    /**
     * programと、それに紐づくmenus,workoutsを削除
     * @param $programId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(string $programId)
    {
        $program = Program::find($programId);
        $program->delete();

        return redirect(route('program.index'));
    }

}
