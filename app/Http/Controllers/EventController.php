<?php

namespace App\Http\Controllers;

use App\Event;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    //todo アクション側でバリデーションをかける

    public function setEvents(Request $request)
    {
        $start = $this->formatDate($request->all()['start']);
        $end = $this->formatDate($request->all()['end']);
        $events = Event::selectEventObjectColumn()->whereBetween('date', [$start, $end])->whereUserId()->get();
        $arr = $this->changeEloquentToAjaxArr($events);

        echo json_encode($arr);
    }

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
        $arr = array_merge(['part_name' => $event->getPartName()], ['event_id' => $event->event_id]);

        return response()->json($arr);
    }

    public function editEventDate(Request $request)
    {
        $data = $request->all();
        $event = Event::find($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }

    public function showEventsByDate(Request $request)
    {
        $date = $request->all()['date'];
        $events = Event::selectEventObjectColumn()->whereUserId()->where('date', $date)->get();

        if (!empty($events)) {
            $arr = $this->changeEloquentToAjaxArr($events);
            return response()->json($arr);
        } else {
            return "non";
        }
    }

    public function delete($eventId){
        $event = Event::find($eventId);
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at");

        $event->max_training_id = null;
        $event->save();
        $trainings->delete();
        $event->delete();

        return redirect("/");

    }

    public function changeEloquentToAjaxArr($events)
    {
        $newArr = [];
        foreach ($events as $event) {
            $newItem["id"] = $event->event_id;
            $newItem["title"] = $event->getPartName();
            $newItem["start"] = $event->date;
            $newArr[] = $newItem;
        }
        return $newArr;
    }

    public function formatDate($date)
    {
        return str_replace('T00:00:00+09:00', '', $date);
    }

}
