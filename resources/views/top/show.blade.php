@extends('layouts.app')
@section('content')

<div class = "wrapper">


    {{ Form::select('stage_code', App\Defs\DefStage::STAGE_NAME_LIST[$thisEvent->part_code],null ,['class' => 'form-stage_code']) }}
    <div>
        {{Form::input('number', 'weight',null,['class' => 'form-weight'])}}kg *
        {{ Form::selectRange('rep', 1, 35, null, ['class' => 'form-rep']) }}rep

        <button class = "add-training-btn _transparent" type="button"><i class="fas fa-plus-circle"></i>追加</button>
    </div>

    <div class = "trainings-index">

        <div class = "today-trainings">
            <div class = "event-title">今回の{{App\Defs\DefPart::PART_NAME_LIST[$thisEvent->part_code]}}トレ {{$thisEvent->date}}</div>
            <div class="this-event-show" data-event_id= {{$thisEvent->event_id}}>
                {{$thisEvent->getMemo()}}
                <div class = "this-trainings">
                    @foreach($thisTrainings as $group)
                        <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                            <span class = "card-title mb-0">{{ $group[0]->getStageName() }}</span>
                            <ol data-stage_code = {{ $group[0]->stage_code }} class = "mb-0">
                            @foreach($group as $training)
                                    @if($training->training_id == $thisEvent->max_training_id)
                                        <li data-training_id = {{$training->training_id}} class = "this-training _add-underline ">{{$training->getWeightAndRep() }}</li>
                                    @else
                                        <li data-training_id = {{$training->training_id}} class = "this-training ">{{$training->getWeightAndRep() }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

            {{Form::open(["url" => "event/delete/$thisEvent->event_id" ])}}
            {{Form::submit('削除')}}
            {{Form::close()}}

        @isset($lastEvent)

            <div class = "last-trainings">
                <div class = "event-title">前回の{{App\Defs\DefPart::PART_NAME_LIST[$lastEvent->part_code]}}トレ {{$lastEvent->date}}</div>
                <div class="this-event-show" data-event_id= {{$lastEvent->event_id}}>
                    {{$lastEvent->getMemo()}}
                    <div class = "last-trainings">
                        @foreach($lastTrainings as $group)
                            <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                                <span class = "card-title mb-0">{{ $group[0]->getStageName() }}</span>
                                <ol data-stage_code = {{ $group[0]->stage_code }} class = "mb-0">
                                @foreach($group as $training)
                                    @if($training->training_id == $lastEvent->max_training_id)
                                        <li data-training_id = {{$training->training_id}} class = "last-training _add-underline ">{{$training->getWeightAndRep() }}</li>
                                    @else
                                        <li data-training_id = {{$training->training_id}} class = "last-training ">{{$training->getWeightAndRep() }}</li>
                                    @endif
                                @endforeach
                                </ol>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @endisset


    </div>
</div>


@endsection