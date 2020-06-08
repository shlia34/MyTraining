@extends('layouts.app')
@section('content')

    追加画面の予定

    <div class = "wrapper">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class = "input-form">
            {{Form::open(["action" => "Web\ExerciseController@store"])}}

            <div>
                {{Form::label('name', '種目名')}}
                {{Form::input('text', 'name')}}
            </div>

            <div>
                <p>部位</p>
                @foreach(App\Defs\DefMuscle::MUSCLE_NAME_LIST as $code => $name )
                    <span class = 'radio-muscle'>
                        {{Form::label('muscle_code', $name ) }}
                        {{Form::radio('muscle_code', $code,false)}}
                    </span>
                @endforeach
            </div>

            <div>
                {{Form::submit('送信')}}
            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection
