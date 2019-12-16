<?php

namespace App\Http\Controllers;

use App\Event;

class EventController extends Controller
{

    public function show($eventId){
        $event = Event::find($eventId);
        return view('event.show')->with(['event' => $event]);
    }
}
