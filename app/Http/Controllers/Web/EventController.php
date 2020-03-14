<?php

namespace App\Http\Controllers\Web;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * カレンダー表示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('event.index');
    }

    /**
     * イベントの詳細ページ。前回のイベントも取得する
     * @param $eventId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $eventId)
    {
        $thisEvent = Event::findOrFail($eventId);
        $thisTrainings = $thisEvent->trainings()->groupByStage();

        $previousEvent = Event::where('part_code',$thisEvent->part_code)->Own()->whereDate("date", "<", $thisEvent->date)->latest("date")->first();
        $previousEvent !== null ? $previousTrainings = $previousEvent->trainings()->groupByStage() : $previousTrainings = [];

        return view('event.show')->with(['thisEvent' => $thisEvent, 'thisTrainings'=> $thisTrainings,
                                              'previousEvent' => $previousEvent, 'previousTrainings' => $previousTrainings,
                                              'stageArray' => Auth::user()->stages()->arrayForSelectBox($thisEvent->part_code) ]);
    }

    /**
     * イベントと、それに紐づくトレーニングを削除
     * @param $eventId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(string $eventId)
    {
        $event = Event::find($eventId);
        $trainings = $event->trainings();
        $trainings->delete();
        $event->delete();

        return redirect("/");
    }

}
