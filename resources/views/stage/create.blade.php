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
            {{Form::open(["action" => "Web\StageController@store"])}}

            <div>
                {{Form::label('name', '種目名')}}
                {{Form::input('text', 'name')}}
            </div>

            <div>
                <p>部位</p>
                @foreach(App\Defs\DefPart::PART_NAME_LIST as $code => $name )
                    <span class = 'radio-part'>
                        {{Form::label('part_code', $name ) }}
                        {{Form::radio('part_code', $code,false)}}
                    </span>
                @endforeach
            </div>

            <div>
                <p>POF</p>
                @foreach(App\Defs\DefPof::POF_LIST as $code => $name )
                    <div>
                        {{Form::label('pof_code', $name ) }}
                        {{Form::radio('pof_code', $code,false)}}
                    </div>
                @endforeach
            </div>

            <div>
                <p>メモ</p>
                {{Form::textarea('memo', null, ['size' => '40x4'])}}
            </div>
            <div>
                {{Form::submit('送信')}}
            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection
