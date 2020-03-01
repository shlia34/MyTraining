<?php

namespace App\Http\Controllers\Web;

use App\Models\Event;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    public function index()
    {
        return view('event.index');
    }

    //todo viewのトレ部分はテンプレートにしたい
    //todo タイマーとかもあったら良い。vibrationAPIたるものがある。chromeで使用可能かどうか調べる
    public function show($eventId){

        $thisEvent = Event::findOrFail($eventId);
        $thisTrainings = $thisEvent->trainings()->orderBy('created_at')->get()->groupBy('stage_id');
        $lastEvent = Event::where('part_code',$thisEvent->part_code)->Own()->whereDate("date", "<", $thisEvent->date)->orderBY("date","desc")->first();

        $lastTrainings = [];
        if(!empty($lastEvent)){
            $lastTrainings = $lastEvent->trainings()->orderBy('created_at')->get()->groupBy('stage_id');
        }

        $stageList = Auth::user()->stages()->where('part_code',$thisEvent->part_code)->orderBy('sort_no')->get();
        $stageFormArr =  [];
        foreach ($stageList as $stage){
            $stageFormArr[$stage->stage_id] = $stage->name;
        }

        return view('event.show')->with(['thisEvent' => $thisEvent, 'thisTrainings'=> $thisTrainings,
                                              'lastEvent' => $lastEvent, 'lastTrainings' => $lastTrainings,
                                              'stageFormArr' => $stageFormArr ]);
    }

    //todo ソフトデリートもやってみたい
    /**
     * イベントと、それに紐づくトレーニングを削除
     * @param $eventId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(string $eventId)
    {
        $event = Event::find($eventId);
        $trainings = Training::where('event_id', $eventId)->orderBY("created_at");

        $trainings->delete();
        $event->delete();

        return redirect("/");
    }

}
