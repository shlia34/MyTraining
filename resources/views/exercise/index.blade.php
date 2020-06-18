@extends('layouts.app')
@section('content')
    <div id="app">
        <div class = "wrapper">
            <exercise-index
                :muscle_code='@json($firstMuscleCode)'>
            </exercise-index>
        </div>

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

@endsection