/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// jquery, popper, Cookies imported through webpack.mix.js
// VENDOR
// import 'bootstrap';                                         // Required for bootstrap tooltips
import 'bootstrap/js/dist/popover';
// import 'bootstrap/js/dist/tooltip';
import 'bootstrap/js/dist/carousel';
import 'bootstrap/js/dist/modal';


// require('bootstrap-select/js/bootstrap-select');                                  // Searchable dropdowns
import 'bootstrap-select/dist/js/bootstrap-select';                                  // Searchable dropdowns
$.fn.selectpicker.Constructor.BootstrapVersion = '4';

import 'cookieconsent';                                     // Cookie consent plugin

import 'jquery-validation/dist/additional-methods.min';     // Plugin for jquery validate
import 'jquery-validation/dist/jquery.validate';            // Frontend form validation
import './scripts/vendor/highlight';                        // Highlight search terms without
import 'bootstrap-slider';                                  // Bootstrap range slider plugin

// UTILITIES
import './scripts/global';                                  // Global Script used for multiple pages
import './scripts/clickToDrag';                             // Click and hold to drag items
import './scripts/scroll';                                  // Smooth scroll
import './scripts/postcode' ;                               // Postcode input
// import './scripts/gmapInit';                             // Gmaps modal
import './scripts/sticky';                                  // Make the search header sticky on scroll
import './scripts/bootstrapSlider';                         // Init the bs slider plugin
import './scripts/survey';                                  // Handle the exit survey form
// window.Vue = require('vue');                             // Vue.js



// Components > Basic
import './components/basic/specialoffer';                   // Toggling special offer slide out
import './components/basic/popover';                        // Trigger bootstrap tooltip
import './components/basic/tooltip';                        // Trigger bootstrap popover
import './components/basic/carousel';                       // Init mobile carousels

// Modals
import './components/modals/modalGeneral';                   // Trigger bootstrap modal
import './components/modals/modalPrivate';                   // Trigger bootstrap modal
import './components/modals/modalMobileTooltips';            // Trigger bootstrap modal
import './components/modals/modalMobileSearchForm';          // Trigger bootstrap modal


import './components/enquiry';                              // Private hospital enquiry form

// PAGES
import './pages/homepage';                                  // Jquery used for the Homepage
import './pages/resultspage';                               // Jquery used for the Results Page
import './pages/faqspage';                                  // Jquery used for the FAQs Page

// COMPONENTS
import './components/compare';
// import './components/doctor';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

