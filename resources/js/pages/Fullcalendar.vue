<template>
    <div>
        <FullCalendar
                :customButtons="calendarCustomButtons"
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
                    <router-link :to="`/programs/${program.id}`">{{program.title}}</router-link>
                    <span v-if="program.max_workout">
                        {{program.max_workout.exercise_name}}{{program.max_workout.weight_and_rep}}
                    </span>
                </li>
            </ul>
        </div>
        <ProgramModal
                :isActive="isModalActive"
                @closeModal="toggelModal"
                @storeProgram="storeProgram"
                ref="ProgramModal"
                v-if="isModalActive"
        />
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid/main';
    import interactionPlugin from '@fullcalendar/interaction/main';
    import ProgramModal from '../components/ProgramModal.vue';
    import {alertError} from '../alert'

    export default {
        mixins:[alertError],
        components: {
            FullCalendar,
            ProgramModal
        },
        data: function() {
            return {
                isModalActive:false,
                calendarPlugins: [
                    dayGridPlugin,
                    interactionPlugin
                ],
                calendarCustomButtons: {
                    storeProgram: {
                        text: '記録',
                        click: this.toggelModal,
                    }
                },
                calendarHeader: {
                    left: 'title',
                    center: '',
                    right: 'prev,next,storeProgram',
                },
                calendarEvents:{
                    url: '/api/programs/set',
                    method: 'GET',
                },
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

                var date =  info.event.start.toISOString();
                date = date.substr( 0, date.indexOf("T") );

                this.showLinksProgram(date);
            },
            dateClick(info){
                var date = info.dateStr;
                this.showLinksProgram(date);
            },
            storeProgram(formData){
                var vm =  this;

                const response = axios.post('/api/programs', formData)
                    .then(function (response) {
                        let calendarApi = vm.$refs.fullCalendar.getApi();
                        calendarApi.addEvent(response.data);

                        vm.showLinksProgram(response.data.start);

                    }).catch(function (error) {
                        vm.alertError(error.response);
                    });

            },
            updateDateProgram(info){
                var vm =  this;
                var data = {
                    "id":info.event.id,
                    "new_date":info.event.start.toISOString(),
                };

                const response = axios.patch('/api/programs', data)
                    .catch(function (error) {
                        vm.alertError(error.response);
                })

            },
            showLinksProgram(date){
                var vm =  this;

                const response = axios.get('/api/programs/links/' + date)
                    .then(function (response) {
                        vm.link.date = response.data.date;
                        vm.link.programs = response.data.programs;
                    })
                    .catch(function (error) {
                        vm.alertError(error.response);
                });
            },
            toggelModal(){
                this.isModalActive = !this.isModalActive;
                console.log(this.isModalActive );
            },
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

    .fc-button-primary {
        color: black!important;
        background-color: white!important;
        border-color: black!important;
        width: 50px;
    }

    .fc-button{
        padding: 2px!important;
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


