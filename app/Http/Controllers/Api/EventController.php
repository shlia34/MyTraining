<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Request\Api\Event\SetRequest;
use App\Http\Request\Api\Event\ShowLinksRequest;
use App\Http\Request\Api\Event\UpdateDateRequest;
use App\Http\Request\Api\Event\StoreRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //todo N+1問題の確認
    /**
     * fullcalendarへ向けてイベントを出力
     * fullcalendar.blade.php
     * @param Request $request
     */
    public function set(SetRequest $request)
    {
        $dates = $request->getFormattedData();
        $eventsJson = Event::whereBetween('date', [ $dates['start'], $dates['end'] ])->Own()->convertToArrForJson();
        return response()->json($eventsJson);
    }

    /**
     * イベント詳細へのリンク表示
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function showLinks(ShowLinksRequest $request)
    {
        $date = $request->getFormattedData()['date'];
        $eventsJson = Event::joinMaxTraining()->Own()->where('date', $date)->orderByPartCode()->convertToArrForJson();
        return response()->json(["date"=>$date,"events"=>$eventsJson]);
    }

    /**
     * イベントをサーバー側で追加し、フロント用のjsonデータを送信
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
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
    public function updateDate(UpdateDateRequest $request)
    {
        $data = $request->getFormattedData();
        $event = Event::find($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }

}
