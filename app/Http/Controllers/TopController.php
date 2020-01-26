<?php

namespace App\Http\Controllers;


use App\Event;
use App\Training;

class TopController extends Controller
{

    public function index()
    {
        return view('top.index');
    }

    //todo 404処理(そのページはもうないです的な)
    //todo 「カレンダーに戻る」ボタンつける
    public function show($eventId){

        if(($event = Event::find($eventId)) == null) {
            abort('404');
        }

        $trainings = Training::where('event_id', $eventId)->orderBY("created_at")->get()->groupBy('stage_code');
        return view('event.show')->with(['event' => $event,'trainings'=>$trainings]);
    }
    //todo chart.jsかなんかでグラフを使用
    //todo タイマーとかもあったら良い
    //todo 筋トレ種目の説明とかのページもあったら良い。コンパウンド、トレーニングのいつやるべき種目なのか
}
