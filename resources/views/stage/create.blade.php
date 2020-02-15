@extends('layouts.app')
@section('content')

    追加画面の予定

    <div class = "wrapper">

        <div class = "input-form">
            {{Form::open(["action" => "StageController@store"])}}

            <div>
                {{Form::label('name', '種目名')}}
                {{Form::input('text', 'name')}}
            </div>

            <div>
                {{Form::label('part_code', '部位')}}
                {{Form::select('part_code', App\Defs\DefPart::PART_NAME_LIST)}}
            </div>

            <div>
                {{Form::label('pof_code', 'pof種目')}}
                {{Form::select('pof_code', App\Defs\DefPof::POF_LIST)}}
            </div>

            <div>
                {{Form::label('memo', 'メモ')}}
                {{Form::textarea('memo')}}
            </div>
            <div>
                {{Form::submit('送信')}}
            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection
