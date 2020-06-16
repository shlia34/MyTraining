@extends('layouts.app')
@section('content')
<div id="app">
    <div class = "wrapper">
        <program-show
            :pid = '@json($programId)' >
        </program-show>
    </div>

</div>

<script src="{{ mix('js/app.js') }}" defer></script>

@endsection
