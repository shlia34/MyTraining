@extends('layouts.app')
@section('content')

    一覧ページの予定

    <p><a class="btn" href="{{url('/stage/create')}}"> ない場合は種目を追加</a></p>

    <div class = "user-stage">
        <h5>やる種目リスト</h5>
        @isset($userStages)
            @foreach($userStages as $group)
                <div class = "user-part-group" data-part_code={{$group[0]->part_code}}>
                    <h6>{{ $group[0]->getPartName() }}</h6>
                    @foreach($group as $stage)
                        <div class ="" data-stage_id= {{$stage->stage_id}}>
                            <a href= "/stage/{{$stage->stage_id }}">{{$stage->name }}</a>
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
            @foreach($leftStages as $group)
                <div class ="left-part-group" data-part_code={{$group[0]->part_code}}>
                    <div><h5>{{ $group[0]->getPartName() }}</h5></div>
                    @foreach($group as $stage)
                        <div class ="" data-stage_id= {{$stage->stage_id}}>
                            <a href= "/stage/{{$stage->stage_id }}">{{$stage->name }}</a>
                            <a class="stage-user-store-btn">追加</a>
                        </div>
                    @endforeach
                </div>

            @endforeach
        @endisset
    </div>

    <div>

    </div>



@endsection
