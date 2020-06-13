@extends('layouts.app')
@section('content')

    <div id="app">
        <div class = "wrapper">
            <fullcalendar></fullcalendar>
        </div>
    </div>

<script src="{{ mix('js/app.js') }}" defer></script>

@endsection
