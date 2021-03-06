<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Request\Api\Program\SetRequest;
use App\Http\Request\Api\Program\UpdateDateRequest;
use App\Http\Request\Api\Program\StoreRequest;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Program\Program as ProgramResource;
use App\Http\Resources\Program\ShowLinks as ShowLinksProgramResource;


class ProgramController extends Controller
{
    /**
     * fullcalendarへ向けてイベントを出力
     * @param SetRequest $request
     */
    public function set(SetRequest $request)
    {
        $dates = $request->all();
        $programs = Program::whereBetween('date', [ $dates['start'], $dates['end'] ])->own()->get();

        return ProgramResource::collection($programs);
    }

    /**
     * プログラムをサーバー側で追加し、フロント用のjsonデータを送信
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $insertData = $request->only('date', 'muscle_code', 'memo')
            + ['id' => $this->generateId('PR')]
            + ['user_id' => Auth::user()->id];

        $program =  Program::create($insertData);

        return new ProgramResource($program);
    }

    /**
     * イベントの日にちを変更
     * @param UpdateDateRequest $request
     * @return |null
     */
    public function updateDate(UpdateDateRequest $request)
    {
        $data = $request->all();
        $program = Program::find($data['id']);
        $program->date = $data['new_date'];
        $program->save();
        return null;
    }

    /**
     * プログラム詳細へのリンク表示
     * @return \Illuminate\Http\JsonResponse
     */
    public function links($date)
    {
        $programs = Program::where('date', $date)->Own()->oldest('muscle_code')->with(['maxWorkout'])->get();
        return response()->json([ "date" => $date, "programs" => ShowLinksProgramResource::collection($programs) ]);
    }

    public function show($id)
    {
        $program = Program::where('id', $id)->with(['menus.workouts'])->first() ?? abort(404);
        return response()->json($program);
    }

    public function previous($date,$muscleCode)
    {
        $program = Program::previous($muscleCode,$date)->with(['menus.workouts'])->first() ?? [];
        //todo menusは分割する？
        return response()->json($program);
    }

    public function delete($id)
    {
        $program = Program::find($id);
        $program->delete();
        return null;
    }


}
