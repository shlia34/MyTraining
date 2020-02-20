<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Training;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;


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

        $thisEvent = Event::findOrFail($eventId);
        $thisTrainings = $thisEvent->trainings();
        if($lastEvent = Event::where('part_code',$thisEvent->part_code)->Own()->whereDate("date", "<", $thisEvent->date)->orderBY("date","desc")->first()){
            $lastTrainings = $lastEvent->trainings();
        }else{
            $lastTrainings = [];
        }
        //todo 三項演算子を検討
        //todo bladeでisset書いたからここもっと楽にできるはず

        $stageList = Auth::user()->stages->where('part_code',$thisEvent->part_code);
        //後でsort_noでなんとかする

        $stageFormArr =  [];
        foreach ($stageList as $stage){
            $stageFormArr[$stage->stage_id] = $stage->name;
        }

        return view('top.show')->with(['thisEvent' => $thisEvent, 'thisTrainings'=>$thisTrainings,
                                            'lastEvent' => $lastEvent, 'lastTrainings' => $lastTrainings,
                                            'stageFormArr' => $stageFormArr ]);
    }
    //todo タイマーとかもあったら良い。vibrationAPIたるものがある。chromeで使用可能かどうか調べる

    public function setting(){
        return view('top.setting');
    }

    public function admin(){
        return view('top.admin');
    }
}
