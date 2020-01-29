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

    <div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
        {{Form::date('date', \Carbon\Carbon::now(), ['class'=>'remodal-date'])}}
        {{Form::select('part_code', App\Defs\DefPart::PART_NAME_LIST,null,['class' => 'remodal-part_code'])}}
        {{Form::input('text', 'memo',null,['class' => 'remodal-memo'])}}
        <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
        <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                defaultView: 'dayGridMonth',
                locales:"ja",
                themeSystem: 'boostrap',
                fixedWeekCount: false,
                editable: true,
                firstDay : 1,
                height: 450,
                eventTextColor:"white",
                selectLongPressDelay:0,
                eventOrder:"part_code",
                events: "/setEvents",
                timeZone: 'UTC',
                customButtons: {
                    addEvent: {
                        text: 'トレ',
                        click: function() {
                            var remodal = $(".remodal").remodal();
                            remodal.open();
                            $(document).off('confirmation').on('confirmation', '.remodal', function () {
                                addEvent(calendar)
                            });
                        }
                    }
                },
                header: {
                    left: 'title',
                    center: '',
                    right: 'prev,next,addEvent',
                },
                prev:"fa-plus",

                eventDrop: function(info){
                    editEventDate(info);
                },
                dateClick: function(info) {
                    showEventsByDate(info.dateStr);
                },
            });
            calendar.render();
        });
    </script>

@endsection
