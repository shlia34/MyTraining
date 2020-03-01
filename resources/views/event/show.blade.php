@extends('layouts.app')
@section('content')

<div class = "wrapper">

    <div class = "add-training-form-box form-inline pt-3 pl-3 pr-3">
        {{ Form::select('stage_id', $stageFormArr,null ,['class' => 'form-stage_id browser-default custom-select mb-2']) }}

        {{--//todo キーパッド入力じゃなくて一桁ずつselectRangeでやるのが、validation楽だし入力しやすいと思った--}}
        <div class="forms">
            <div class="md-form m-0 ml-3 w-25">
                <input type="number" id="form-weight" class="form-weight form-control">
                <label for="form-weight">weight</label>
            </div>

            <div class="md-form m-0 ml-3 w-25">
                <input type="number"  id="form-rep" class="form-rep form-control">
                <label for="form-rep">rep</label>
            </div>
            @if($stageFormArr === [])
                <a href ="/stages/index?partCode={{$thisEvent->part_code}}"><button class = "btn waves-effect w-30 ml-4" type="button">種目<i class="fas fa-cog"></i></button></a>
            @else
                <button class = "add-training-btn btn waves-effect w-30 ml-4" type="button" disabled>記録</button>
            @endif
        </div>
    </div>

    <div class = "trainings-index  pb-4">

        <div class = "today-trainings">
            <a  href="/event/{{$thisEvent->event_id}}">
                <div class = "event-title">{{$thisEvent->date}}の{{App\Defs\DefPart::PART_NAME_LIST[$thisEvent->part_code]}}トレ</div>
            </a>
            <div class="this-event-show" data-event_id= {{$thisEvent->event_id}}>
                <span class = "event-memo">{{$thisEvent->getMemo()}}</span>
                <div class = "this-trainings">
                    @foreach($thisTrainings as $group)
                        <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                            <span class = "mb-0">
                                <a class = "card-title" href="/stages/{{$group[0]->stage_id}}">{{ $group[0]->getStageName() }}</a>
                            </span>
                            <ol data-stage_id = {{ $group[0]->stage_id }} class = "ol-training mb-0">
                            @foreach($group as $training)
                                @if($training->is_max === 1)
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
            <div>
                <a href="/event/{{$thisEvent->event_id}}/destroy"><i class="fas fa-trash ml-2"></i></a>
                <div class="float-right"><a  href={{url()->previous()}}><button>戻る</button></a></div>
            </div>


        </div>


        @isset($lastEvent)

            <div class = "last-trainings">
                <a href="/event/{{$lastEvent->event_id}}">
                    <div class = "event-title">{{$lastEvent->date}}の{{App\Defs\DefPart::PART_NAME_LIST[$lastEvent->part_code]}}トレ</div>
                </a>
                <div class="last-event-show" data-event_id= {{$lastEvent->event_id}}>
                    <span class = "event-memo">{{$lastEvent->getMemo()}}</span>
                    <div class = "last-trainings">
                        @foreach($lastTrainings as $group)
                            <div class = "card mt-2 mb-2 mr-2 ml-2 p-2">
                                <span class = "mb-0">
                                    <a class = "card-title" href="/stages/{{$group[0]->stage_id}}">{{ $group[0]->getStageName() }}</a>
                                </span>
                                <ol data-stage_id = {{ $group[0]->stage_id }} class = "ol-training mb-0">
                                @foreach($group as $training)
                                    @if($training->is_max === 1)
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

<div class="training-remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class = "training-remodal-box"></div>
</div>

@endsection
