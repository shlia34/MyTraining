import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import fullcalendar  from './pages/Fullcalendar.vue'
import ProgramShow from './pages/ProgramShow.vue'
import ExerciseIndex from './pages/ExerciseIndex.vue'
import ExerciseShow from './pages/ExerciseShow.vue'
import Csv from './pages/Csv.vue'
import Search from './pages/Search.vue'



Vue.use(VueRouter);

// パスとコンポーネントのマッピング
const routes = [
    {
        path: '/',
        component: fullcalendar,

    },
    {
        path: '/programs/:program_id',
        component: ProgramShow,
        props: true,
    },
    {
        path: '/exercises/index/:muscle_code',
        component: ExerciseIndex,
        props:true,
    },
    {
        path: '/exercises/:exercise_id',
        component: ExerciseShow,
        props: true,
    },
    {
        path: '/csv/index',
        component: Csv,
    },
    {
        path: '/search/:model',
        component: Search,
        props: true,
    },
];

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
});

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router