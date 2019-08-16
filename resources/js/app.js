/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');

import router from './router/index';

/**
 * Handle token expired exception.
 */
import interceptors from './interceptors';
interceptors();

/**
 * Vuetify - Material Design Component Framework
 * More details on https://vuetifyjs.com/en/
 */
import Vuetify from 'vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
const vuetifyOptions = {};
Vue.use(Vuetify);

/**
 * Markdown editor.
 */
import md from 'marked';
import VueSimplemde from 'vue-simplemde';
Vue.component('vue-simplemde', VueSimplemde);
window.md = md;

/**
 * Register User helper.
 */
import User from './helpers/User';
window.User = User;

/**
 * Register EventBus to emit between components.
 */
window.EventBus = new Vue();

/**
 * Register components.
 */
Vue.component('app-home', require('./components/AppHome.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// eslint-disable-next-line
const app = new Vue({
  el: '#app',
  vuetify: new Vuetify(vuetifyOptions),
  router,
});
