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

    //todo viewファイルをtopのディレクトリに移動
    //todo viewのトレ部分はテンプレートにしたい
    //todo topControllerという名前も検討
    //todo lastEventが存在しない場合の処理
    //todo 追加ボタンを上にする。日付はモーダルから。プラスだけにする。
    //todo　上の隙間も解消
    public function show($eventId){

        if(($thisEvent = Event::find($eventId)) == null) {
            abort('404');
        }
        $thisTrainings = Training::getTrainingsArrFromEventId($eventId);

        $lastEvent = Event::where('part_code',$thisEvent->part_code)->whereDate("date", "<", $thisEvent->date)->orderBY("date","desc")->first();
        $lastTrainings = Training::getTrainingsArrFromEventId($lastEvent->event_id);

        return view('event.show')->with([ 'thisEvent' => $thisEvent,
                                               'thisTrainings'=>$thisTrainings,
                                               'lastEvent' => $lastEvent,
                                               'lastTrainings' => $lastTrainings ]);
    }
    //todo chart.jsかなんかでグラフを使用
    //todo タイマーとかもあったら良い
    //todo 筋トレ種目の説明とかのページもあったら良い。コンパウンド、トレーニングのいつやるべき種目なのか
}
