<template>
    <div>
        <FullCalendar :customButtons="calendarCustomButtons"
                :events="calendarEvents"
                :firstDay=1
                :fixedWeekCount=false
                :header="calendarHeader"
                :height=450
                :plugins="calendarPlugins"
                @dateClick="dateClick"
                @eventClick="eventClick"
                @eventDrop="eventDrop"
                defaultView="dayGridMonth"

                editable="true"
                eventDurationEditable=false
                eventOrder="muscle_code"
                eventTextColor="white"
                id = "calendar"
                locales="ja"
                ref="fullCalendar"
                selectLongPressDelay=0
                themeSystem="bootstrap"
                timeZone="ja"
                      ></FullCalendar>
        <div class = "show-program">
            <p>{{link.date}}</p>
            <ul>
                <li v-for="program in link.programs">
                    <a v-bind:href="'/programs/' + program.id">{{program.title}}</a>
                    <span v-if="program.max_workout">
                        {{program.max_workout.exercise_name}}{{program.max_workout.weight_and_rep}}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction'
    export default {
        components: {
            FullCalendar,
        },
        data: function() {
            return {
                calendarPlugins: [
                    dayGridPlugin,
                    interactionPlugin
                ],
                calendarCustomButtons: {
                    storeProgram: {
                        text: '記録',
                        click: function() {
                            var remodal = $(".program-remodal").remodal();
                            remodal.open();
                            $(document).off('confirmation').on('confirmation', '.program-remodal', function () {
                                storeProgram(calendar)
                            });
                        }
                    }
                },
                calendarHeader: {
                    left: 'title',
                    center: '',
                    right: 'prev,next,storeProgram',
                },
                calendarEvents: "/api/programs/set",
                link: {
                    date:"",
                    programs:[],
                }
            }
        },
        methods: {
            eventDrop(info){
                this.updateDateProgram(info);
            },
            eventClick(info){
                this.showLinksProgram(info.event.start.toISOString());
            },
            dateClick(info){
                this.showLinksProgram(info.dateStr);
            },

            updateDateProgram(info){
                var vm =  this;
                var data = {
                    "id":info.event.id,
                    "new_date":info.event.start.toISOString(),
                };

                const response = axios.post('/api/programs/updateDate', data)
                    .catch(function (error) {
                        vm.alertError(error.response);
                })

            },
            showLinksProgram(date){
                var vm =  this;
                var data = {"date":date};

                const response = axios.post('/api/programs/showLinks', data)
                    .then(function (response) {
                        vm.link.date = response.data.date;
                        vm.link.programs = response.data.programs;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                });
            },
            alertError(response) {
                var errors = response.data.errors;

                $.each(errors, function(index, value) {
                    alert(value);
                });
            }
        }
    }



</script>

<style>
    #calendar {
        font-size: 14px;
    }

    .fc-toolbar.fc-header-toolbar {
        margin-bottom: 0px;
        background-color: #454545;
    }

    .fc-right {
        padding: 10px;
    }

    .fc-left {
        padding: 4px;
        color: white;
    }

    .fc-today{
        background-color: #f5f5f5!important;
    }

    @media screen and (max-width: 480px) {

        .fc-event {
            font-size: 10px !important;/*--event title font size--*/
            /*margin-bottom: 4px;!*--　帯の隙間 event clearance--*!*/
        }

        .fc-day-number{
            font-size: 12px;
        }

        /*-- ヘッダ　ツールバー --*/
        .fc-header-toolbar{
            position: -webkit-sticky;
            position: sticky;
            top: 54.22px;
            z-index:10;
            background-color:#e9e9e9;/*--背景色--*/
        }
        .fc-center h2{ /*-- 年月表示 --*/
            /*margin-top:10px;*/
        }
        /*-- カレンダーヘッダ Sun to Sat --*/
        .fc-head{
            position: -webkit-sticky;
            position: sticky;
            top: calc(47.05px + 54.22px);
            z-index:11;
            background-color:#c8c8c8;/*--背景色--*/
            color: #454545;
        }
    }
</style>


