@extends('layouts.app')
@section('content')
    {{$event->event_id}}
    {{$event->part_code}}
    {{$event->date}}
    {{$event->memo}}

@endsection
