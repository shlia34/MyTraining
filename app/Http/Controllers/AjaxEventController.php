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
        $events = Event::select('event_id', 'part_code', 'date')->where('user_id',Auth::user()->user_id)->get();
        $arr = $events->toArray();

        $newArr = [];

        foreach ($arr as $val){
            $newVal = array_merge($val,array('part_name'=>$this->revertPartName($val['part_code'])));
            unset($newVal['part_code']);
            $newArr[] = $newVal;

        }

        return response()->json($newArr);
    }

    public function addEvent(Request $request)
    {
        $data = $request->all();
        $event = new Event();
        $event->event_id = $data['id'];
        $event->date = $data['date'];
        $event->part_code = $data['part_code'];
        $event->memo = $data['memo'] ?? "";
        $event->user_id = Auth::user()->user_id;
        $event->save();

        $partName = $this->revertPartName($data['part_code']);

        return response()->json($partName);
    }

    public function editEventDate(Request $request){
        $data = $request->all();
        $event = $this->getEventFromId($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }

    public function revertPartName($partCode){
        return DefPart::PART_LIST[$partCode];
    }
}
