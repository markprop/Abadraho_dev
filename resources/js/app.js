import helperjs from '../../public/js/helper';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
// require("../../public/js/helper");
window.Vue = require('vue').default;
window.axios = require('axios');
// Vue.loadScript("../../public/js/helper")




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('compare-project', require('./components/CompareProject.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Only initialize Vue if the app element exists
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('app')) {
        // Suppress Vue development warnings
        Vue.config.silent = true;
        Vue.config.productionTip = false;
        Vue.config.devtools = false;
        
        const app = new Vue({
            el: '#app',
        });
    }
});
