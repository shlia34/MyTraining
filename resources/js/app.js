/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
Vue.component('fullcalendar', require('./pages/Fullcalendar.vue').default);
Vue.component('program-show', require('./pages/ProgramShow.vue').default);
Vue.component('exercise-index', require('./pages/ExerciseIndex.vue').default);
Vue.component('exercise-show', require('./pages/ExerciseShow.vue').default);


const app = new Vue({
}).$mount('#app');
