/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
Vue.component('fullcalendar', require('./components/Fullcalendar.vue').default);
// Vue.component('product-modal', require('./components/ProductModal.vue').default);


const app = new Vue({
}).$mount('#app');
