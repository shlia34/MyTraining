@extends('layouts.app')
@section('content')


    <p><a class="btn" href="{{url('/csv/download/Event')}}" target="_blank"> Event Download</a></p>
    <p><a class="btn" href="{{url('/csv/download/Training')}}" target="_blank"> Training Download</a></p>
    <p><a class="btn" href="{{url('/csv/download/Stage')}}" target="_blank"> stage Download</a></p>
    <p><a class="btn" href="{{url('/csv/download/User')}}" target="_blank"> user Download</a></p>


    <form action="/csv/event/import" method="post" enctype="multipart/form-data">
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
        <button type="submit" class="btn btn-block">Event Import</button>
    </form>


    <script>
        // ファイルを選択すると、コントロール部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
            $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })
    </script>
@endsection
