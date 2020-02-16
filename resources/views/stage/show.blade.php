@extends('layouts.app')
@section('content')

    詳細画面の予定

    <p>{{$stage->stage_id }}</p>
    <p>{{$stage->name }}</p>
    <p>{{$stage->getPartName() }}</p>
    <p>{{$stage->getPofName() }}</p>
    <p>{{$stage->memo }}</p>

    紐づいてるトレーニングも表示する


@endsection
