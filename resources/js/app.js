/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Vue from 'vue'
import router from './router'
import App from './App.vue'

// const createApp = async () => {
    new Vue({
        el: '#app',
        router, // ルーティングの定義を読み込む
        components: { App }, // ルートコンポーネントの使用を宣言する
        template: '<App />' // ルートコンポーネントを描画する
    });
// };

// createApp();