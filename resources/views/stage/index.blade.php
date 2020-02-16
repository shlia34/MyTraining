@extends('layouts.app')
@section('content')

    一覧ページの予定

    <p><a class="btn" href="{{url('/stage/create')}}"> ない場合は種目を追加</a></p>

    @foreach($stages as $group)
        {{ $group[0]->getPartName() }}
        @foreach($group as $stage)
        <div><a href= "/stage/{{$stage->stage_id }}">{{$stage->name }}</a></div>
        @endforeach
    @endforeach


@endsection
