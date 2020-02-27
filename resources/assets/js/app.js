require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);

Vue.component("app-home", require("./components/AppHome.vue").default);

import User from './Helpers/User'
window.User = User;

window.EventBus = new Vue();

import router from './router/index';

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    router
});
