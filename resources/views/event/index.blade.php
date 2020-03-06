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
        {{Form::select('part_code', App\Defs\DefPart::PART_NAME_LIST,null,['class' => 'remodal-part_code'])}}
        {{Form::input('text', 'memo',null,['class' => 'remodal-memo'])}}
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
                editable: true,
                firstDay : 1,
                height: 450,
                eventTextColor:"white",
                selectLongPressDelay:0,
                eventOrder:"part_code",
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
                prev:"fa-plus",

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
