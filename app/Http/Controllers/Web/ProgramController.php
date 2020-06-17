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
     * 詳細ページ。
     * @param $programId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $programId)
    {
        return view('program.show')->with(['programId' => $programId]);
    }

}
