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



