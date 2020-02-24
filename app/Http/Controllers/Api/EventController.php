<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SetEventsRequest;

class EventController extends Controller
{
    //todo N+1問題の確認
    //todo formRequestでバリデーション、整形をする
    /**
     * fullcalendarへ向けてイベントを出力
     * fullcalendar.blade.php
     * @param Request $request
     */
    public function set(SetEventsRequest $request)
    {

        $dates = $request->getFormattedDates();

        $eventsJson = Event::whereBetween('date', [ $dates['start'], $dates['end'] ])->Own()->convertToArrForJson();

        return response()->json($eventsJson);
    }

    /**
     * ISO形式の日付を「2020-01-01」のように整形
     * @param $date
     * @return mixed
     */
    public function formatIsoDate($date)
    {
        if(strpos($date,'T') ) {
            return strstr($date, 'T', true);
        }else{
            return $date;
        }
    }

    /**
     * イベント詳細へのリンク表示
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function showLinks(Request $request)
    {
        $date = $this->formatIsoDate($request->all()['date']);
        $eventsJson = Event::joinMaxTraining()->Own()->where('date', $date)->orderByPartCode()->convertToArrForJson();

        return response()->json(["date"=>$date,"events"=>$eventsJson]);
    }

    /**
     * イベントをサーバー側で追加し、フロント用のjsonデータを送信
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $event = new Event();
        $event->event_id = $this->generateId('EV');
        $event->date = $data['date'];
        $event->part_code = $data['part_code'];
        $event->memo = $data['memo'] ?? "";
        $event->user_id = Auth::user()->user_id;
        $event->save();
        $eventJson = $event->getDataForJson();
        return response()->json($eventJson);
    }

    /**
     * イベントの日にちを変更
     * @param Request $request
     * @return |null
     */
    public function updateDate(Request $request)
    {
        $data = $request->all();
        $event = Event::find($data['id']);
        $event->date = $this->formatIsoDate($data['newDate']);
        $event->save();
        return null;
    }

}
