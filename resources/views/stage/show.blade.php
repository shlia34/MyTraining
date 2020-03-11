@extends('layouts.app')
@section('content')
<div class = "wrapper">
    <div class = "">
            <div style = "height: 32px;"><a class = "float-right"  href={{url()->previous()}}><button >戻る</button></a></div>
        <div class = "event-title">{{$stage->name }}</div>
        <div class="t" >
            <div class = "">
            @if($trainings->total() !== 0)
                @foreach($trainings as $eventId => $group)
                    <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                        <span class = "mb-0">
                            <a class = "card-title" href="/events/{{ $group[0]->event_id }}">{{ $group[0]->date }}</a>
                        </span>
                        <ol data-event_id = {{$eventId}} class = "ol-training mb-0">
                        @foreach($group as $training)
                            @if($training->is_max == 1)
                                <li data-training_id = {{$training->training_id}} class = "stage-training _add-underline ">{{$training->getWeightAndRep() }}</li>
                            @else
                                <li data-training_id = {{$training->training_id}} class = "stage-training">{{$training->getWeightAndRep() }}</li>
                            @endif
                        @endforeach
                        </ol>
                    </div>
                @endforeach
                {{ $trainings->links() }}
            @else
                <span>まだこの種目やってません</span>
            @endif
            </div>
        </div>
    </div>
</div>

@endsection
