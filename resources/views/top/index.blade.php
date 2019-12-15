@extends('layouts.app')
@section('content')
    <div class = "wrapper">
        <div id="calendar"></div>

        <div class = "sample">
            <button class = "add-event-btn" type="button">追加</button>
        </div>
    </div>


    <div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h1>タイトル</h1>
        <p>コンテンツを記述します。</p>
        <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
        <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
    </div>

@endsection
