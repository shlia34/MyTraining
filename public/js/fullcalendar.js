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
        // スマホでタップしたとき即反応
        eventOrder:"part_code",
        // part_code順に並び替え

        events: "/setEvents",

        eventClick: function(info) {
            showEventsByDate(info.event.start);
        },

        eventDragStart: function(info){
            showEventsByDate(info.event.start);
        },

        eventDrop: function(info){
            editEventDate(info);
            showEventsByDate(info.event.start);
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