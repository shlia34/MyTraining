@extends('layouts.app')
@section('content')

<div class = "wrapper">

    <div class = "add-training-form-box form-inline pt-3 pl-3 pr-3">
        {{ Form::select('stage_id', $stageArray,null ,['class' => 'form-stage_id browser-default custom-select mb-2']) }}

        <div class="forms">
            <div class="md-form m-0 ml-3 w-25">
                <input type="number" id="form-weight" class="form-weight form-control">
                <label for="form-weight">weight</label>
            </div>

            <div class="md-form m-0 ml-3 w-25">
                <input type="number"  id="form-rep" class="form-rep form-control">
                <label for="form-rep">rep</label>
            </div>
            @if($stageArray === [])
                <a href ="/stages/index?partCode={{$thisEvent->part_code}}"><button class = "btn waves-effect w-30 ml-4" type="button">種目<i class="fas fa-cog"></i></button></a>
            @else
                <button class = "add-training-btn btn waves-effect w-30 ml-4" type="button" disabled>記録</button>
            @endif
        </div>
    </div>

    <div class = "trainings-index  pb-4">
        @include('partials.event', ['event' => $thisEvent, 'trainings' => $thisTrainings, 'type' => 'this' ])
        <div>
            <a href="/events/{{$thisEvent->event_id}}/destroy"><i class="fas fa-trash ml-2"></i></a>
            <div class="float-right"><a  href={{url()->previous()}}><button>戻る</button></a></div>
        </div>

        @isset($previousEvent)
            @include('partials.event',['event'=>$previousEvent,'trainings'=>$previousTrainings,'type'=>'previous'])
        @endisset
    </div>
</div>

<div data-remodal-id="true-training-remodal" data-remodal-options="hashTracking:false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <button class="remodal-btn off-max-training-btn">マックスをオフ</button>
</div>

<div data-remodal-id="false-training-remodal" data-remodal-options="hashTracking:false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <button class="remodal-btn on-max-training-btn">マックスに登録</button>
    <button class="remodal-btn delete-training-btn">削除</button>
</div>

@endsection
