@extends('layouts.app')
@section('content')

    @foreach($modelNames as $modelName)
        <p><a class="btn" href="{{ route('csv.export', ['modelName' => $modelName]) }}" target="_blank"> {{$modelName}} Export</a></p>
    @endforeach

    <form action="/csv/import" method="post" enctype="multipart/form-data">
    <form action={{ route('csv.import') }} method="post" enctype="multipart/form-data">

        {{ csrf_field() }}
        <div class="row">
            <label class="col-1 text-right" for="form-file-1">File:</label>
            <div class="col-11">
                <div class="custom-file">
                    <input type="file" name="csv" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile" data-browse="参照">ファイル選択...</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block">Import</button>
    </form>

    <script>
        // ファイルを選択すると、コントロール部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
            $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })
    </script>
@endsection
