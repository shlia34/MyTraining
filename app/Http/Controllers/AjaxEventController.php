<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Defs\DefPart;

class AjaxEventController extends Controller
{

    public function getEventFromId($id){
        return  Event::find($id);
    }

    public function setEvents(){
        $events = Event::select('event_id', 'part_code', 'date')->whereUserId()->get();
        $newArr = $this->changeEloquentToAjaxArr($events);

        return response()->json($newArr);
    }

    public function changeEloquentToAjaxArr($eloquent){
        $arr = $eloquent->toArray();

        $newArr = [];
        foreach ($arr as $val){
            $newVal = array_merge($val,array('part_name'=>$this->revertPartName($val['part_code'])));
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
        $arr = array_merge([ 'part_name' => $partName ], ['event_id' => $event->event_id ]);


        return response()->json($arr);
    }

    public function editEventDate(Request $request){
        $data = $request->all();
        $event = $this->getEventFromId($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }

    public function showEventsByDate(Request $request){
        $date = $request->all()['date'];
        $events = Event::select('event_id', 'part_code')->whereUserId()->where('date',$date)->get();


        if(!empty($events)){
            $newArr = $this->changeEloquentToAjaxArr($events);
            return response()->json($newArr);
        } else {
            return "non";
        }
    }

    //TODO 文字コード変換のがbladeとここでかぶってるからまとめたい。場所もここじゃない。
    public function revertPartName($partCode){
        return DefPart::PART_LIST[$partCode];
    }
}
