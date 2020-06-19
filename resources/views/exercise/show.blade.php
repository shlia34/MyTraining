@extends('layouts.app')
@section('content')
    <div id="app">
        <div class = "wrapper">
            <exercise-show
                :exercise_id='@json($exerciseId)'
                :default_page='@json($page)'
            >
            </exercise-show>
        </div>

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

@endsection





{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{--<div class = "wrapper">--}}
{{--    <div class = "">--}}
{{--        <div style = "height: 32px;"><a class = "float-right"  href={{url()->previous()}}><button >戻る</button></a></div>--}}
{{--        <div class = "program-title">{{ $exercise->name }}</div>--}}
{{--        <div class = "">--}}
{{--        @if($menus->total() !== 0)--}}
{{--            @foreach($menus as $menu)--}}
{{--                <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">--}}
{{--                    <span class = "mb-0">--}}
{{--                        <a class = "card-title" href="/programs/{{ $menu->program_id }}">{{ $menu->date }}</a>--}}
{{--                    </span>--}}
{{--                    <ol data-program_id = {{$menu->program_id}} class = "ol-workout mb-0">--}}
{{--                        @foreach($menu->workouts as $workout)--}}
{{--                            @include('partials.workout', [ 'group' => $menu->workouts, 'type' => 'exercise' ])--}}
{{--                        @endforeach--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--            {{ $menus->links() }}--}}
{{--        @else--}}
{{--            <span>まだこの種目やってません</span>--}}
{{--        @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{ mix('js/app.js') }}" defer></script>--}}

{{--@endsection--}}
