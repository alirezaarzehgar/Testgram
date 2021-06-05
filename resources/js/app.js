/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('v-post', require('./components/Post').default);
Vue.component('v-fullscreen-post', require('./components/FullScreenPost').default);
Vue.component('v-slider', require('./components/ImageSlider').default);
Vue.component('v-like-comment', require('./components/LikeComment').default);
Vue.component('v-comment', require('./components/Comment').default);
Vue.component('v-follower-modal', require('./components/FollowersModal').default);
Vue.component('v-following-modal', require('./components/FollowingsModal').default);
Vue.component('v-member', require('./components/Member').default);
Vue.component('v-followings-header', require('./components/FollowingsHeader').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
