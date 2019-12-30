<?php

namespace App\Http\Controllers;

use App\Defs\DefPart;
use App\Event;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{

    public function getEventFromId($id)
    {
        return Event::find($id);
    }

    public function formatDate($date)
    {
        return str_replace('T00:00:00+09:00', '', $date);
    }

    public function show($eventId){
        $event = Event::find($eventId);
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at")->get();

        return view('event.show')->with(['event' => $event,'trainings'=>$trainings]);
    }

    public function setEvents(Request $request)
    {

        $start = $this->formatDate($request->all()['start']);
        $end = $this->formatDate($request->all()['end']);

        $events = Event::select('event_id', 'part_code', 'date')->whereBetween('date', [$start, $end])->whereUserId()->get();
        $arr = $this->changeEloquentToAjaxArr($events);

        $newArr = [];
        foreach ($arr as $item) {
            $newItem["id"] = $item["event_id"];
            $newItem["title"] = $item["part_name"];
            $newItem["start"] = $item["date"];
            $newArr[] = $newItem;
        }

        echo json_encode($newArr);
    }

    public function changeEloquentToAjaxArr($eloquent)
    {
        $arr = $eloquent->toArray();

        $newArr = [];
        foreach ($arr as $val) {
            $newVal = array_merge($val, array('part_name' => $this->revertPartName($val['part_code'])));
            unset($newVal['part_code']);
            $newArr[] = $newVal;

        }
        return $newArr;
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


        $partName = $this->revertPartName($data['part_code']);
        $arr = array_merge(['part_name' => $partName], ['event_id' => $event->event_id]);


        return response()->json($arr);
    }

    public function editEventDate(Request $request)
    {
        $data = $request->all();
        $event = $this->getEventFromId($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }

    public function showEventsByDate(Request $request)
    {
        $date = $request->all()['date'];
        $events = Event::select('event_id', 'part_code')->whereUserId()->where('date', $date)->get();


        if (!empty($events)) {
            $newArr = $this->changeEloquentToAjaxArr($events);
            return response()->json($newArr);
        } else {
            return "non";
        }
    }

    //TODO 文字コード変換のがbladeとここでかぶってるからまとめたい。場所もここじゃない。
    public function revertPartName($partCode)
    {
        return DefPart::PART_LIST[$partCode];
    }

}
