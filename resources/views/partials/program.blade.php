<a href="/events/{{$program->event_id}}">
    <div class = "event-title">{{$program->date}}の{{$program->part_name}}トレ</div>
</a>
<div class="{{$type}}-event-show" data-event_id= {{$program->id}}>
    <span class = "event-memo">{{$program->memo}}</span>
    <div class = "{{$type}}-trainings">
        @foreach($program->menus as $menu)
            <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                <span class = "mb-0">
                    <a class = "card-title" href="/stages/{{$menu->exercise_id}}">{{ $menu->name }}</a>
                </span>
                <ol data-stage_id = {{ $menu->exercise_id }} class = "ol-training mb-0">
                    @foreach($menu->workouts as $workout)
                        @include('partials.workout', [ 'group' => $menu->workouts, 'type' => $type ])
                    @endforeach
                </ol>
            </div>
        @endforeach
    </div>
</div>