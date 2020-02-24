@extends('layouts.app')
@section('content')

    一覧ページの予定

    <p><a class="btn" href="{{url('/stages/create')}}"> ない場合は種目を追加</a></p>

    <div class = "user-stage">
        <h5>やる種目リスト</h5>

        @isset($userStages)
            @foreach($userStages as $partCode=>$group)
                <div class = "user-part-group" data-part_code={{$partCode}}>
                    <h6>{{ \App\Defs\DefPart::PART_NAME_LIST[$partCode] }}</h6>
                    @foreach($group as $stage)
                        <div class ="" data-stage_id= {{$stage->stage_id}}>
                            <a href= "/stages/{{$stage->stage_id }}">{{$stage->name }}</a>
                            <a class="stage-user-delete-btn">削除</a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endisset


    </div>

    <div class = "left-stage">
        <h5>追加してないの種目リスト</h5>
        @isset($leftStages)
            @foreach($leftStages as $partCode=>$group)
                <div class ="left-part-group" data-part_code={{$partCode}}>
                    <h6>{{ \App\Defs\DefPart::PART_NAME_LIST[$partCode] }}</h6>
                    @foreach($group as $stage)
                        <div class ="" data-stage_id= {{$stage->stage_id}}>
                            <a href= "/stages/{{$stage->stage_id }}">{{$stage->name }}</a>
                            <a class="stage-user-store-btn">追加</a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endisset
    </div>


@endsection
