@extends('layouts.app')
@section('content')

<div class = "wrapper">

    <div class = "event-show" data-event_id = {{$event->event_id}}>
        <ul>
            <li>{{$event->date}}</li>
            <li>{{App\Defs\DefPart::PART_NAME_LIST[$event->part_code]}}</li>
            {{$event->memo}}
            <li>
                {{Form::open(["url" => "event/delete/$event->event_id" ])}}
                    {{Form::submit('削除')}}
                {{Form::close()}}
            </li>
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
            <ul class = "trainings">
                @foreach($trainings as $stage_code => $group)
                    {{App\Defs\DefStage::STAGE_LIST[$event->part_code][$stage_code]}}
                    @foreach($group as $training)
                        @if($training->training_id == $event->max_training_id)
                            <li data-training_id = {{$training->training_id}} class = "training _add-underline">
                        @else
                            <li data-training_id = {{$training->training_id}} class = "training">
                        @endif
                        {{$training->weight}}kg * {{$training->rep}}rep
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>





@endsection