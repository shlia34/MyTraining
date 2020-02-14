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

    //todo viewのトレ部分はテンプレートにしたい
    //todo topControllerという名前も検討
    //todo いいねと削除はmodel,後いろんなことの編集もできるように
    public function show($eventId){

        if(($thisEvent = Event::find($eventId)) == null) {
            abort('404');
        }
        $thisTrainings = Training::getTrainingsFromEventId($eventId);

        if($lastEvent = Event::where('part_code',$thisEvent->part_code)->whereDate("date", "<", $thisEvent->date)->orderBY("date","desc")->first()){
            $lastTrainings = Training::getTrainingsFromEventId($lastEvent->event_id);
        }else{
            $lastTrainings = [];
        }
        //todo 三項演算子を検討
        //todo bladeでisset書いたからここもっと楽にできるはず

        return view('top.show')->with(['thisEvent' => $thisEvent, 'thisTrainings'=>$thisTrainings,
                                            'lastEvent' => $lastEvent, 'lastTrainings' => $lastTrainings ]);
    }
    //todo タイマーとかもあったら良い。vibrationAPIたるものがある。chromeで使用可能かどうか調べる
    //todo 筋トレ種目の説明とかのページもあったら良い。コンパウンド、トレーニングのいつやるべき種目なのか

    public function setting(){
        return view('top.setting');
    }
}
