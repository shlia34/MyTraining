<?php

namespace App\Http\Controllers;


use App\Event;
use App\Training;

class TopController extends Controller
{

    public function index()
    {
        return view('top.index');
    }

    public function show($eventId){
        $event = Event::find($eventId);
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at")->get();

        return view('event.show')->with(['event' => $event,'trainings'=>$trainings]);
    }
}
