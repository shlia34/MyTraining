@extends('layouts.app')
@section('content')
    <div class = "wrapper">
        <div id="calendar"></div>

        <div class = "show-event">
            <div>
                <p></p>
                <ul></ul>
            </div>
        </div>
    </div>

    <div class="event-remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
        {{Form::date('date', \Carbon\Carbon::now(), ['class'=>'remodal-date'])}}
        {{Form::select('part_code', App\Defs\DefPart::PART_NAME_LIST,null,['class' => 'remodal-part_code'])}}
        {{Form::input('text', 'memo',null,['class' => 'remodal-memo','placeholder'=>'メモ'])}}
        <button data-remodal-action="confirm" class="remodal-btn store-event-btn">追加</button>
    </div>

@endsection
