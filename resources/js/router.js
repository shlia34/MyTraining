import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import fullcalendar  from './pages/Fullcalendar.vue'
import ProgramShow from './pages/ProgramShow.vue'
import ExerciseIndex from './pages/ExerciseIndex.vue'
import ExerciseShow from './pages/ExerciseShow.vue'



Vue.use(VueRouter);

// パスとコンポーネントのマッピング
const routes = [
    {
        path: '/',
        component: fullcalendar,

    },
    {
        path: '/programs/:pid',
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
];

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
});

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router