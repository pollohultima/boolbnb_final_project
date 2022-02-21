/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter)
window.Vue = require('vue');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
const Home = Vue.component('Home', require('./pages/Home.vue').default);
const Apartments = Vue.component('Apartments', require('./pages/Apartments.vue').default);
const Apartment = Vue.component('Apartment', require('./pages/Apartment.vue').default);

Vue.component('App', require('./App.vue').default);                         
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/apartments',
        name: 'apartments',
        component: Apartments
    },
    {
        path: '/apartments/:slug',
        name: 'apartment',
        component: Apartment
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router,
    el: '#app',

});

const user_age = Number (prompt ("Quanti anni ha?"));
