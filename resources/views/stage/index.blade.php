@extends('layouts.app')
@section('content')

    <p><a class="btn" href="{{url('/stages/create')}}"> ない場合は種目を追加</a></p>

    @foreach($arr as $partCode=>$stageGroups)
        <div class ="part-group" data-part_code={{$partCode}}>
            <h4>{{ \App\Defs\DefPart::PART_NAME_LIST[$partCode] }}</h4>
            @foreach($stageGroups as $stageGroup=>$stages)

                @if($stageGroup === "userStage")
                    <h5>やる種目リスト</h5>
                    <div class = "user-stage">
                        @foreach($stages as $stage)
                            <div class ="" data-stage_id= {{$stage->stage_id}}>
                                <a href= "/stages/{{$stage->stage_id }}">{{$stage->name }}</a>
                                <a class="stage-user-delete-btn">削除</a>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($stageGroup === "leftStage")
                    <h5>追加してないの種目リスト</h5>
                    <div class = "left-stage">
                        @foreach($stages as $stage)
                            <div class ="" data-stage_id= {{$stage->stage_id}}>
                                <a href= "/stages/{{$stage->stage_id }}">{{$stage->name }}</a>
                                <a class="stage-user-store-btn">追加</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach

@endsection
