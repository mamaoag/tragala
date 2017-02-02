
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import {store} from './store'

Vue.component('friend', require('./components/Friend.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('unread', require('./components/Unread.vue'));
Vue.component('post', require('./components/Post.vue'));
Vue.component('feed', require('./components/Feed.vue'));
Vue.component('actions', require('./components/Actions.vue'));
Vue.component('comment', require('./components/Comment.vue'));
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('users', require('./components/Users.vue'));
Vue.component('form-post', require('./components/Form.vue'));
Vue.component('edit', require('./components/Edit.vue'));
Vue.component('latest', require('./components/Latest.vue'));
Vue.component('hot', require('./components/Hot.vue'));
Vue.component('report', require('./components/Report.vue'));
Vue.component('report-list', require('./components/ReportList.vue'));
Vue.component('audit', require('./components/Audit.vue'));

const app = new Vue({
    el: '#app',
    store
});
