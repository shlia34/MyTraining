@extends('layouts.app')
@section('content')
    <div class = "wrapper">
        <div id="calendar"></div>

        <div class = "sample">
            <button class = "add-event-btn" type="button">追加</button>
        </div>
        <div class = "show-event">
            <p></p>
            <ul></ul>
        </div>
    </div>

    <div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking:false">
        <button data-remodal-action="close" class="remodal-close"></button>
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
                editable: true,
                selectable: true,
                firstDay : 1,
                height: 465,
                eventTextColor:"white",
                selectLongPressDelay:0,
                eventOrder:"part_code",
                events: "/setEvents",
                timeZone: 'UTC',

                eventDrop: function(info){
                    editEventDate(info);
                },
                dateClick: function(info) {
                    showEventsByDate(info.dateStr);

                    $(".add-event-btn").off('click').on("click",function(){
                        var remodal = $(".remodal").remodal();
                        remodal.open();

                        $(document).off('confirmation').on('confirmation', '.remodal', function () {
                            addEvent(calendar,info)
                        });
                    });
                },
            });
            calendar.render();
        });
    </script>

@endsection
