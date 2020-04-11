<a href="/events/{{$event->event_id}}">
    <div class = "event-title">{{$event->date}}の{{$event->part_name}}トレ</div>
</a>
<div class="{{$type}}-event-show" data-event_id= {{$event->event_id}}>
    <span class = "event-memo">{{$event->memo}}</span>
    <div class = "{{$type}}-trainings">
        @foreach($trainings as $group)
            <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                <span class = "mb-0">
                    <a class = "card-title" href="/stages/{{$group[0]->stage_id}}">{{ $group[0]->stage_name }}</a>
                </span>
                <ol data-stage_id = {{ $group[0]->stage_id }} class = "ol-training mb-0">
                    @foreach($group as $training)
                        @include('partials.training', [ 'group' => $group, 'type' => $type ])
                    @endforeach
                </ol>
            </div>
        @endforeach
    </div>
</div>