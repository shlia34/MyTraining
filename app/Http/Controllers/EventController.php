<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    //todo N+1問題の確認
    //todo アクション側でバリデーションをかける
    /**
     * fullcalendarへ向けてイベントを出力
     * fullcalendar.blade.php
     * @param Request $request
     */
    public function setEvents(Request $request)
    {
        $start = $this->formatIsoDate($request->all()['start']);
        $end = $this->formatIsoDate($request->all()['end']);

        $newStart = date("Y-m-d",strtotime($start . "-35 day"));
        $newEnd = date("Y-m-d",strtotime($end . "+35 day"));
        //広めに取得しておく

        $eventsJson = Event::whereBetween('date', [$newStart, $newEnd])->Own()->convertToArrForJson();
        return response()->json($eventsJson);
    }

    /**
     * イベントをサーバー側で追加し、フロント用のjsonデータを送信
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addEvent(Request $request)
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
    public function editEventDate(Request $request)
    {
        $data = $request->all();
        $event = Event::find($data['id']);
        $event->date = $this->formatIsoDate($data['newDate']);
        $event->save();
        return null;
    }

    /**
     * イベントの詳細表示のためのjsonデータを送信
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function showEventsByDate(Request $request)
    {
        $date = $this->formatIsoDate($request->all()['date']);
        $eventsJson = Event::joinMaxTraining()->Own()->where('date', $date)->orderByPartCode()->convertToArrForJson();

        return response()->json(["date"=>$date,"events"=>$eventsJson]);
    }

    //todo ソフトデリートもやってみたい
    /**
     * イベントと、それに紐づくトレーニングを削除
     * @param $eventId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(string $eventId)
    {
        $event = Event::find($eventId);
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at");

        $trainings->delete();
        $event->delete();

        return redirect("/");
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

}
