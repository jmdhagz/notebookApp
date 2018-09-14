
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetAlert2 from 'vue-sweetalert2';
import Toasted from 'vue-toasted';
 
Vue.use(VueAxios, axios)
Vue.use(VueSweetAlert2);
Vue.use(BootstrapVue)
Vue.use(Toasted);

var VueTruncate = require('vue-truncate-filter')
Vue.use(VueTruncate)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('items', require('./components/Item.vue'));
Vue.component('test', require('./components/Test.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('rfid', require('./components/Rfid.vue'));
Vue.component('leftsidebar', require('./components/LeftSidebar.vue'));
Vue.component('visitednotebooksidebar', require('./components/VisitedNotebookSidebar.vue'));
Vue.component('pinnednotes', require('./components/PinnedNotes.vue'));
Vue.component('typeahead', require('./components/Typeahead.vue'));
Vue.component('archive', require('./components/Archive.vue'));
Vue.component('testing', require('./components/Testing.vue'));
Vue.component('visitednotebook', require('./components/VisitedNotebook.vue'));
Vue.component('bin', require('./components/Bin.vue'));

// Vue Instances
const app = new Vue({
    el: '#app'
});

const dashboard = new Vue({
    el: '#dashboard'
});

const archive = new Vue({
    el: '#archive'
});

const test = new Vue({
	el: '#testContainer'
});

const rfid = new Vue({
	el: '#rfidContainer'
});

const login = new Vue({
	el: '#login'
});

const testing = new Vue({
	el: '#testing'
});

const visitednotebook = new Vue({
	el: '#visitednotebook'
});

const bin = new Vue({
	el: '#bin'
});