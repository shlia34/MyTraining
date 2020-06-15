@extends('layouts.app')
@section('content')
<div id="app">

    <div class = "wrapper">

        <workout-form
                :exercises="{{$exercises}}"
                :program="{{$thisProgram}}"
        ></workout-form>

        <div class = "workouts-index  pb-4">
            <program
                    :program="{{$thisProgram}}"
                    :clickable="true"
            ></program>
            <div>
                <a href="/programs/{{$thisProgram->id}}/destroy"><i class="fas fa-trash ml-2"></i></a>
                <div class="float-right"><a  href={{url()->previous()}}><button>戻る</button></a></div>
            </div>

            @isset($previousProgram)
                <program
                        :program="{{$previousProgram}}"
                        :clickable="false"
                ></program>
            @endisset
        </div>
    </div>

    <div data-remodal-id="true-workout-remodal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <button class="remodal-btn off-max-workout-btn">マックスをオフ</button>
    </div>

    <div data-remodal-id="false-workout-remodal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <button class="remodal-btn on-max-workout-btn">マックスに登録</button>
        <button class="remodal-btn delete-workout-btn">削除</button>
    </div>

</div>

<script src="{{ mix('js/app.js') }}" defer></script>

@endsection
