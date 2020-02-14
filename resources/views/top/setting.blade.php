@extends('layouts.app')
@section('content')

    <p><a class="btn" href="{{url('/csv/event/download')}}" target="_blank"> Event Download</a></p>

    <p><a class="btn" href="{{url('/csv/training/download')}}" target="_blank"> Training Download</a></p>


@endsection
