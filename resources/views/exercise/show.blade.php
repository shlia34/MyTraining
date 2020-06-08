@extends('layouts.app')
@section('content')
<div class = "wrapper">
    <div class = "">
        <div style = "height: 32px;"><a class = "float-right"  href={{url()->previous()}}><button >戻る</button></a></div>
        <div class = "event-title">{{ $exercise->name }}</div>
        <div class = "">
        @if($menus->total() !== 0)
            @foreach($menus as $menu)
                <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                    <span class = "mb-0">
                        <a class = "card-title" href="/programs/{{ $menu->program_id }}">{{ $menu->date }}</a>
                    </span>
                    <ol data-event_id = {{$menu->program_id}} class = "ol-training mb-0">
                        @foreach($menu->workouts as $workout)
                            @include('partials.workout', [ 'group' => $menu->workouts, 'type' => 'stage' ])
                        @endforeach
                    </ol>
                </div>
            @endforeach
            {{ $menus->links() }}
        @else
            <span>まだこの種目やってません</span>
        @endif
        </div>
    </div>
</div>

@endsection
