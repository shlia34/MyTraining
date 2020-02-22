@extends('layouts.app')
@section('content')
<div class = "wrapper">
    <div class = "">
            <div class = "event-title">{{$stage->name }}</div>
        <div class="" >
            <div class = "">
                @foreach($trainings as $eventId => $group)
                    <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                        <a href="/event/{{ $group[0]->event_id }}">
                            <span class = "card-title mb-0">{{ $group[0]->date }}</span>
                        </a>
                        <ol data-event_id = {{$eventId}} class = "ol-training mb-0">
                        @foreach($group as $training)
                            @if($training->is_max === 1)
                                <li data-training_id = {{$training->training_id}} class = "stage-training _add-underline ">{{$training->getWeightAndRep() }}</li>
                            @else
                                <li data-training_id = {{$training->training_id}} class = "stage-training">{{$training->getWeightAndRep() }}</li>
                                @endif
                        @endforeach
                        </ol>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
