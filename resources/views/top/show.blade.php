@extends('layouts.app')
@section('content')

<div class = "wrapper special-color-dark pb-2">

    <div class = "add-training-form-box form-inline pt-3 pl-3 pr-3">
        {{ Form::select('stage_code', App\Defs\DefStage::STAGE_NAME_LIST[$thisEvent->part_code],null ,['class' => 'form-stage_code browser-default custom-select mb-2']) }}
        <div class="forms">
            <div class="md-form m-0 ml-3 w-25">
                <input type="number" id="form-weight" class="form-weight form-control">
                <label for="form-weight">weight</label>
            </div>

            <div class="md-form m-0 ml-3 w-25">
                <input type="number" id="form-rep" class="form-rep form-control">
                <label for="form-rep">rep</label>
            </div>
            <button class = "add-training-btn _transparent btn btn-dark waves-effect w-30 ml-4" type="button">追加</button>
        </div>
    </div>

    <div class = "trainings-index">

        <div class = "today-trainings">
            <div class = "event-title">{{$thisEvent->date}}の{{App\Defs\DefPart::PART_NAME_LIST[$thisEvent->part_code]}}トレ</div>
            <div class="this-event-show" data-event_id= {{$thisEvent->event_id}}>
                {{$thisEvent->getMemo()}}
                <div class = "this-trainings">
                    @foreach($thisTrainings as $group)
                        <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                            <span class = "card-title mb-0">{{ $group[0]->getStageName() }}</span>
                            <ol data-stage_code = {{ $group[0]->stage_code }} class = "ol-training mb-0">
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

        <a href="/event/delete/{{$thisEvent->event_id}}">イベント削除</a>

        @isset($lastEvent)

            <div class = "last-trainings">
                <div class = "event-title">{{$lastEvent->date}}の{{App\Defs\DefPart::PART_NAME_LIST[$lastEvent->part_code]}}トレ</div>
                <div class="this-event-show" data-event_id= {{$lastEvent->event_id}}>
                    {{$lastEvent->getMemo()}}
                    <div class = "last-trainings">
                        @foreach($lastTrainings as $group)
                            <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                                <span class = "card-title mb-0">{{ $group[0]->getStageName() }}</span>
                                <ol data-stage_code = {{ $group[0]->stage_code }} class = "ol-training mb-0">
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