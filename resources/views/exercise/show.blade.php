@extends('layouts.app')
@section('content')
<div class = "wrapper">
    <div class = "">
        <div style = "height: 32px;"><a class = "float-right"  href={{url()->previous()}}><button >戻る</button></a></div>
        <div class = "event-title">{{$stage->name }}</div>
        <div class = "">
        @if($trainings->total() !== 0)
            @foreach($trainings as $eventId => $group)
                <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                    <span class = "mb-0">
                        <a class = "card-title" href="/events/{{ $group[0]->event_id }}">{{ $group[0]->date }}</a>
                    </span>
                    <ol data-event_id = {{$eventId}} class = "ol-training mb-0">
                        @foreach($group as $training)
                            @include('partials.workout', [ 'group' => $group, 'type' => 'stage' ])
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

@endsection
