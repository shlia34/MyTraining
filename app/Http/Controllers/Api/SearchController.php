<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Program;
use App\Models\Menu;
use App\Models\Exercise;
use App\Http\Resources\Program\Search as SearchProgramResource;


class SearchController extends Controller
{
    public function program(Request $request)
    {
        $items =  Program::Own()->with(['maxWorkout'])->search($request->all())->get();
        return SearchProgramResource::collection($items);
    }

    public function menu(Request $request)
    {
        $items =  Menu::joinExercise()->joinProgram()->search($request->all())->get();
        return $items;
    }

    public function workout(Request $request)
    {
        $items =  Workout::joinMenu()->joinProgram()->joinExercise()->search($request->all())->get();
        return $items;
    }

    public function exercise(Request $request)
    {
        $items =  Exercise::search($request->all())->get();
        return $items;
    }


}
