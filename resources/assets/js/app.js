var Vue = require('vue');
// Vue Recource
var VueResource = require('vue-resource');
Vue.use(VueResource);
// Vue Router
var VueRouter = require('vue-router');
Vue.use(VueRouter);
// Vue Mement
var VueMoment = require('vue-moment');
Vue.use(VueMoment);
// Vue sticky scroll
var stickyScroll = require('vue-sticky-scroll');

// Pusher
require('pusher-js')
// define as a global variable

 /**
 * [pusher librabry instance]
 * NOTE This Is the pusher-js Library
 * @type {Pusher}
 */

window.pusher = new Pusher('2f13ba6c99034dd7203c',{
    cluster: 'eu',
});

// Vue Spinner
var MoonLoader = require('vue-spinner/dist/vue-spinner.min').MoonLoader;
// make it as global component
Vue.component('spinner', MoonLoader);
// Vue Recource init Headers With laravel csrf_token
Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').attr('value');

// Define Components
var addRoom = require('./components/rooms/addRoom.vue');
var allRooms = require('./components/rooms/allRooms.vue');
var myRooms = require('./components/rooms/myRooms.vue');
var chatBox = require('./components/chatbox/chatBox.vue');
var sidebar = require('./components/includes/sidebar.vue');
var profile = require('./components/profile/profile.vue');
Vue.component('sidebar', sidebar);

// Vue Router init
var App = Vue.extend({});
var route = new VueRouter();

// Define some routes.
route.map({
    '/': {
        component: allRooms
    },
    '/addRoom': {
        component: addRoom
    },
    '/allRooms': {
        component: allRooms
    },
    '/myRooms': {
        component: myRooms
    },
    '/chat/:room_id/:room_name': {
        name: '/chatBox',
        component: chatBox
    },
    '/profile/:user_id/:user_name': {
        name: '/profile',
        component: profile
    },
});

// Now we can start the app!
route.start(App, 'body');
