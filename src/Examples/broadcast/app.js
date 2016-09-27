import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://app.dev:6001'
});

// Vue.config.devtools = true;
Vue.component('my-announcement', require('./Announcement.vue'));

const app = new Vue({
    el: 'body'
});
