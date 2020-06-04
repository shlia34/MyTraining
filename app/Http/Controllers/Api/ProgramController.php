<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Request\Api\Program\SetRequest;
use App\Http\Request\Api\Program\ShowLinksRequest;
use App\Http\Request\Api\Program\UpdateDateRequest;
use App\Http\Request\Api\Program\StoreRequest;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Program as ProgramResource;

class ProgramController extends Controller
{
    /**
     * fullcalendarへ向けてイベントを出力
     * @param SetRequest $request
     */
    public function set(SetRequest $request)
    {
        $dates = $request->getFormattedData();
        $programs = Program::whereBetween('date', [ $dates['start'], $dates['end'] ])->Own()->get();

        return ProgramResource::collection($programs);
    }

    /**
     * プログラム詳細へのリンク表示
     * @param ShowLinksRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showLinks(ShowLinksRequest $request)
    {
        $date = $request->getFormattedData()['date'];
        $programs = Program::joinMaxTraining()->where('date', $date)->Own()->oldest('muscle_code')->get();

        return response()->json([ "date" => $date, "events" => ProgramResource::collection($programs) ]);
    }

    /**
     * プログラムをサーバー側で追加し、フロント用のjsonデータを送信
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $insertData = $request->only('date', 'muscle_code', 'memo')
                    + ['id' => $this->generateId('EV')]
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
        $data = $request->getFormattedData();
        $program = Program::find($data['id']);
        $program->date = $data['newDate'];
        $program->save();
        return null;
    }

}
