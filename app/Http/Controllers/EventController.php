<?php

namespace App\Http\Controllers;

use App\Event;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //todo アクション側でバリデーションをかける
    /**
     * fullcalendarへ向けてイベントを出力
     * use fullcalendar.js
     * @param Request $request
     */
    public function setEvents(Request $request)
    {
        $start = $this->formatDate($request->all()['start']);
        $end = $this->formatDate($request->all()['end']);
        $events = Event::joinMaxTraining()->whereBetween('date', [$start, $end])->whereUserId()->get();
        $arr = $this->changeEloquentToAjaxArr($events);
        echo json_encode($arr);
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
        $arr = $event->getArrForAjax();

        return response()->json($arr);
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
        $event->date = $data['newDate'];
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
        $date = $request->all()['date'];
        $events = Event::joinMaxTraining()->whereUserId()->where('date', $date)->orderByPartCode()->get();

        if (!empty($events)) {
            $arr = $this->changeEloquentToAjaxArr($events);
            return response()->json($arr);
        } else {
            return "non";
        }
    }

    //todo ソフトデリートもやってみたい

    /**
     * イベント削除
     * @param $eventId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(string $eventId){
        $event = Event::find($eventId);
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at");

        $event->max_training_id = null;
        $event->save();
        $trainings->delete();
        $event->delete();

        return redirect("/");
    }

    //todo この処理の場所は気になる
    public function changeEloquentToAjaxArr($events)
    {
        $arr = [];
        foreach ($events as $event) {
            $arr[] = $event->getArrForAjax();
        }
        return $arr;
    }



    /**
     * fullcalendarから受け取った日付を「2020-01-01」のように整形
     * @param $date
     * @return mixed
     */
    public function formatDate($date)
    {
        return str_replace('T00:00:00+09:00', '', $date);
    }

}
