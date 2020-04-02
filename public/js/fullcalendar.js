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