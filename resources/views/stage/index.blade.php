@extends('layouts.app')
@section('content')

    一覧ページの予定

    <p><a class="btn" href="{{url('/stage/create')}}"> ない場合は種目を追加</a></p>

    <div class = "user-stage">
        @isset($userStages)
            @foreach($userStages as $group)
                {{ $group[0]->getPartName() }}
                @foreach($group as $stage)
                    <div><a href= "/stage/{{$stage->stage_id }}">{{$stage->name }}</a></div>
                @endforeach
            @endforeach
        @endisset
    </div>

    <div class = "all-stage">
        {{Form::open(["action" => "UserStageController@store"])}}
        @isset($allStages)
            @foreach($allStages as $group)
                 <div><h5>{{ $group[0]->getPartName() }}</h5></div>
                @foreach($group as $stage)
                <div>
                    <span>{{ $stage->name }}</span>
                    {{Form::checkbox( "stageIds[]",$stage->stage_id )}}
                </div>
                @endforeach
            @endforeach
        @endisset
    </div>

    <div>
        {{Form::submit('保存')}}
    </div>
    {{Form::close()}}



@endsection
