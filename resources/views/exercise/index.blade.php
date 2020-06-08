@extends('layouts.app')
@section('content')

    <p><a class="btn" href="{{route('exercise.create')}}">ない場合は種目を追加</a></p>
    <a href={{url()->previous()}}><button>前のページに戻る</button></a>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach(\App\Defs\DefMuscle::MUSCLE_NAME_LIST as $muscleCode=>$muscleName )
            <li class="nav-item">
            @if ($firstMuscleCode === $muscleCode)
                <a class="nav-link active"
            @else
                <a class="nav-link"
            @endif
                id="{{$muscleName}}-tab" data-toggle="tab" href="#{{$muscleName}}" role="tab" aria-controls={{$muscleName}} aria-selected="false">
                    {{ \App\Defs\DefMuscle::MUSCLE_SHORT_NAME_LIST[$muscleCode] }}</a>
            </li>
        @endforeach
    </ul>

<div class="tab-content" id="myTabContent">
    @foreach($exerciseByMuscle as $muscleCode => $exerciseGroups)
        @if ($firstMuscleCode === $muscleCode)
            <div class="tab-pane fade show active"
        @else
            <div class="tab-pane fade"
        @endif

            id={{ \App\Defs\DefMuscle::MUSCLE_NAME_LIST[$muscleCode] }} role="tabpanel" aria-labelledby="{{ \App\Defs\DefMuscle::MUSCLE_NAME_LIST[$muscleCode] }}-tab">
        <div class ="muscle-group" data-muscle_code={{$muscleCode}}>
            <h4>{{ \App\Defs\DefMuscle::MUSCLE_NAME_LIST[$muscleCode] }}</h4>
            @foreach($exerciseGroups as $exerciseGroup => $exercises)

                @if($exerciseGroup === "routine")
                    <h5>やる種目リスト</h5>
                    <div class = "routines">
                        @foreach($exercises as $exercise)
                            <div class ="" data-exercise_id= {{$exercise->exercise_id}}>
                                <span>{{$exercise->name }}</span><a href= "/exercises/{{$exercise->exercise_id }}"><i class="fas fa-angle-right"></i></a>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($exerciseGroup === "notRoutine")
                    <h5>追加してないの種目リスト</h5>
                    <div class = "not-routines">
                        @foreach($exercises as $exercise)
                            <div class ="" data-exercise_id= {{$exercise->id}}>
                                <span>{{$exercise->name }}</span><a href= "/exercises/{{$exercise->id }}"><i class="fas fa-angle-right"></i></a>
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
