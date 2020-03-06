@extends('layouts.app')
@section('content')

    <p><a class="btn" href="{{url('/stages/create')}}">ない場合は種目を追加</a></p>
    <a href={{url()->previous()}}><button>前のページに戻る</button></a>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach(\App\Defs\DefPart::PART_NAME_LIST as $partCode=>$partName )
            <li class="nav-item">
            @if ($firstPartCode === $partCode)
                <a class="nav-link active"
            @else
                <a class="nav-link"
            @endif
                id="{{$partName}}-tab" data-toggle="tab" href="#{{$partName}}" role="tab" aria-controls={{$partName}} aria-selected="false">
                    {{ \App\Defs\DefPart::PART_SHORT_NAME_LIST[$partCode] }}</a>
            </li>
        @endforeach
    </ul>

<div class="tab-content" id="myTabContent">
    @foreach($arr as $partCode=>$stageGroups)
        @if ($firstPartCode === $partCode)
            <div class="tab-pane fade show active"
        @else
            <div class="tab-pane fade"
        @endif

            id={{ \App\Defs\DefPart::PART_NAME_LIST[$partCode] }} role="tabpanel" aria-labelledby="{{ \App\Defs\DefPart::PART_NAME_LIST[$partCode] }}-tab">
        <div class ="part-group" data-part_code={{$partCode}}>
            <h4>{{ \App\Defs\DefPart::PART_NAME_LIST[$partCode] }}</h4>
            @foreach($stageGroups as $stageGroup=>$stages)

                @if($stageGroup === "userStage")
                    <h5>やる種目リスト</h5>
                    <div class = "user-stage">
                        @foreach($stages as $stage)
                            <div class ="" data-stage_id= {{$stage->stage_id}}>
                                <span>{{$stage->name }}</span><a href= "/stages/{{$stage->stage_id }}"><i class="fas fa-angle-right"></i></a>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($stageGroup === "leftStage")
                    <h5>追加してないの種目リスト</h5>
                    <div class = "left-stage">
                        @foreach($stages as $stage)
                            <div class ="" data-stage_id= {{$stage->stage_id}}>
                                <span>{{$stage->name }}</span><a href= "/stages/{{$stage->stage_id }}"><i class="fas fa-angle-right"></i></a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection
