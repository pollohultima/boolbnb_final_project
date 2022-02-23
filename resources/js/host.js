const { values } = require('lodash');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

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


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    mounted() {
        var options = {
            searchOptions: {
                key: 'L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs',
                language: 'it-IT',
                limit: 5,
                countrySet: 'IT'
            },
            autocompleteOptions: {
                key: 'L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs',
                language: 'it-IT',
                resultSet: 'street'
            },
            labels: {
                placeholder: 'Inserisci il tuo indirizzo',
                noResultsMessage: 'Nessun riferimento trovato.'
            },
        };
        var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
        var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
        searchBoxHTML.getElementsByClassName('tt-search-box-input')[0].id = 'address';
        searchBoxHTML.getElementsByClassName('tt-search-box-input')[0].name = 'address';
        var temp_address = document.getElementById("temp_address").value;
        searchBoxHTML.getElementsByClassName('tt-search-box-input')[0].setAttribute("value", temp_address);
        document.getElementById('searchbox').append(searchBoxHTML);
        /*  document.getElementsByClassName('tt-search-box-input')[0].id = 'address'; 
       document.getElementsByClassName('tt-search-box-input')[0].name = 'address';
       document.getElementsByClassName('tt-search-box-input')[0].setAttribute("value", "{{ old('address') }}"); */
    }
});
