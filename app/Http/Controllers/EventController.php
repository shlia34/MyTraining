<?php

namespace App\Http\Controllers;

use App\Event;
use App\Training;

class EventController extends Controller
{

    public function show($eventId){
        $event = Event::find($eventId);
        //todo 並び替えを作られた日にち？
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at")->get();

        return view('event.show')->with(['event' => $event,'trainings'=>$trainings]);
    }
}
