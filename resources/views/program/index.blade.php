@extends('layouts.app')
@section('content')
    <div class = "wrapper">
        <div id="calendar"></div>

        <div class = "show-event">
            <div>
                <p></p>
                <ul></ul>
            </div>
        </div>
    </div>

    <div class="event-remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
        {{Form::date('date', \Carbon\Carbon::now(), ['class'=>'remodal-date'])}}
        {{Form::select('muscle_code', App\Defs\DefPart::PART_NAME_LIST,null,['class' => 'remodal-part_code'])}}
        {{Form::input('text', 'memo',null,['class' => 'remodal-memo','placeholder'=>'メモ'])}}
        <button data-remodal-action="confirm" class="remodal-btn store-event-btn">追加</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                defaultView: 'dayGridMonth',
                locales:"ja",
                timeZone: 'ja',
                themeSystem: 'bootstrap',
                fixedWeekCount: false,
                //trueの場合は常に6週間表示。falseなら日付の数に合わせて変わる(4,5,6週)
                editable: true,
                //カレンダー上での編集を可能に
                eventDurationEditable: false,
                //期間を変更させない(日付のドラックしかできないようになる)
                firstDay : 1,
                //月曜日から始める
                height: 450,
                eventTextColor:"white",
                selectLongPressDelay:0,
                // スマホでタップしたとき即反応
                eventOrder:"part_code",
                //part_code順に並び替え
                events: "/api/events/set",
                customButtons: {
                    storeEvent: {
                        text: '記録',
                        click: function() {
                            var remodal = $(".event-remodal").remodal();
                            remodal.open();
                            $(document).off('confirmation').on('confirmation', '.event-remodal', function () {
                                storeEvent(calendar)
                            });
                        }
                    }
                },
                header: {
                    left: 'title',
                    center: '',
                    right: 'prev,next,storeEvent',
                },

                eventDrop: function(info){
                    updateDateEvent(info);
                },
                eventClick: function(info){
                    showLinksEvent(info.event.start.toISOString());
                },
                dateClick: function(info) {
                    showLinksEvent(info.dateStr);
                },
            });
            calendar.render();
        });
    </script>

@endsection
