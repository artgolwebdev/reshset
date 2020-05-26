
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

//Vue.component('example', require('./components/Example.vue'));

Vue.component('init',require('./components/Init.vue'));
Vue.component('friend', require('./components/Friend.vue'));
Vue.component('unreadnots',require('./components/menu/UnreadNots.vue'));
Vue.component('post',require('./components/Post.vue'));
Vue.component('feed',require('./components/Feed.vue'));
Vue.component('signlepost',require('./components/SignlePost.vue'));
Vue.component('search',require('./components/Search.vue'));
Vue.component('user-friends',require('./components/UserFriends.vue'));
Vue.component('nav-search',require('./components/NavSearch.vue'));
Vue.component('friends-location',require('./components/FriendsLocation.vue'));
Vue.component('chat-app', require('./components/chat/ChatApp.vue'));
Vue.component('unread-messages',require('./components/menu/UnreadMessages.vue'));
Vue.component('edit-profile-btn',require('./components/EditProfileBtn.vue'));

import { store } from './store';  


const app = new Vue({
    el: '#app' , 
    store 
});

Noty.overrideDefaults({
    type : 'success' , 
    layout : 'topCenter', 
    theme : 'relax'  ,
    progressBar : true , 
    timeout : 6500,
});
