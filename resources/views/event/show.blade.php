@extends('layouts.app')
@section('content')

<div class = "wrapper">


    {{ Form::select('stage_code', App\Defs\DefStage::STAGE_LIST[$thisEvent->part_code],null ,['class' => 'form-stage_code']) }}
    <div>
        {{Form::input('number', 'weight',null,['class' => 'form-weight'])}}kg *
        {{ Form::selectRange('rep', 1, 35, null, ['class' => 'form-rep']) }}rep

        <button class = "add-training-btn _transparent" type="button"><i class="fas fa-plus-circle"></i>追加</button>
    </div>

    <div class = "trainings-index">
        <div class = "today-trainings">
            <div class = "event-title">今回の{{App\Defs\DefPart::PART_NAME_LIST[$thisEvent->part_code]}}トレ {{$thisEvent->date}}</div>
            <div class = "this-event-show" data-event_id = {{$thisEvent->event_id}}>
                <ul>
                    {{$thisEvent->memo}}

                </ul>
            </div>

            <div class = "space">
                <ul class = "today-trainings">
                    @foreach($thisTrainings as $stageCode => $group)
                        {{ App\Defs\DefStage::getStageName($stageCode) }}
                        @foreach($group as $training)
                            @if($training->training_id == $thisEvent->max_training_id)
                                <li data-training_id = {{$training->training_id}} class = "this-training _add-underline">
                            @else
                                <li data-training_id = {{$training->training_id}} class = "this-training">
                            @endif
                            {{$training->weight}}kg * {{$training->rep}}rep
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>

        <li>
            {{Form::open(["url" => "event/delete/$thisEvent->event_id" ])}}
            {{Form::submit('削除')}}
            {{Form::close()}}
        </li>

        <div class = "last-trainings">
            <div class = "event-title">前回の{{App\Defs\DefPart::PART_NAME_LIST[$lastEvent->part_code]}}トレ {{$lastEvent->date}}</div>
            <div class = "last-event-show" data-event_id = {{$lastEvent->event_id}}>
                <ul>
                    {{$lastEvent->memo}}
                </ul>
            </div>
            <ul class = "last-trainings">
                @foreach($lastTrainings as $stageCode => $group)
                    {{ App\Defs\DefStage::getStageName($stageCode) }}
                    @foreach($group as $training)
                        @if($training->training_id == $lastEvent->max_training_id)
                            <li data-training_id = {{$training->training_id}} class = "last-training _add-underline">
                        @else
                            <li data-training_id = {{$training->training_id}} class = "last-training">
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