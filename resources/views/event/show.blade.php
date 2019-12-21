@extends('layouts.app')
@section('content')
{{--    {{$event->event_id}}--}}



<div class = "wrapper">

    <div class = "event-show" id = {{$event->event_id}}>
        <ul>
            <li>{{$event->date}}</li>
            <li>{{App\Defs\DefPart::PART_LIST[$event->part_code]}}</li>
            {{$event->memo}}
        </ul>

    </div>

    {{ Form::select('stage_code', App\Defs\DefStage::STAGE_LIST[$event->part_code],null ,['class' => 'form-stage_code']) }}
    <div>
        {{Form::input('number', 'weight',null,['class' => 'form-weight'])}}kg *
        {{ Form::selectRange('rep', 1, 30, null, ['class' => 'form-rep']) }}rep

        <button class = "add-training-btn _transparent" type="button"><i class="fas fa-plus-circle"></i>追加</button>
    </div>
    <div class = "trainings-index">
        <h5>今日のトレーニング</h5>
        <div class = "space">
            @foreach($trainings as $training)
                <ul>
                    <li>{{App\Defs\DefStage::STAGE_LIST[$event->part_code][$training->stage_code]}}</li>
                    <li>{{$training->weight}}kg * {{$training->rep}}rep</li>
                </ul>
            @endforeach
        </div>
    </div>
</div>





@endsection