<a href="/programs/{{$program->id}}">
    <div class = "program-title">{{$program->date}}の{{$program->part_name}}トレ</div>
</a>
<div class="{{$type}}-program-show" data-program_id= {{$program->id}}>
    <span class = "program-memo">{{$program->memo}}</span>
    <div class = "{{$type}}-workouts">
        @foreach($program->menus as $menu)
            <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                <span class = "mb-0">
                    <a class = "card-title" href="/exercises/{{$menu->exercise_id}}">{{ $menu->name }}</a>
                </span>
                <ol data-menu_id = {{ $menu->id }} class = "ol-workout mb-0">
                    @foreach($menu->workouts as $workout)
                        @include('partials.workout', [ 'group' => $menu->workouts, 'type' => $type ])
                    @endforeach
                </ol>
            </div>
        @endforeach
    </div>
</div>