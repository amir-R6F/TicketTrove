

require('./bootstrap');

window.Vue = require('vue').default;

import helper from "./plugin/helper";
import Vue from 'vue'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('movie-component', require('./components/movie/MovieComponent.vue').default);
Vue.component('login-component', require('./components/auth/LoginComponent.vue').default);
Vue.component('register-component', require('./components/auth/RegisterComponent.vue').default);


Vue.prototype.$helper = helper;
const app = new Vue({
    el: '#app',
});
