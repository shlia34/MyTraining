document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid' ],
        defaultView: 'dayGridMonth',
        editable: true,
        slotEventOverlap: false,
        selectable: true,
        selectHelper: true,
        firstDay : 1,
        eventDurationEditable : false,

        eventClick: function(info) {

        },

        eventDragStart: function(info){

        },

        eventDrop: function(info) {

        },

        dateClick: function(info) {


        },

    });

    calendar.render();
});