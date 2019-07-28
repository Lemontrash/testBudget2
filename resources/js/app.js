/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router.js'
import VueApexCharts from 'vue-apexcharts'
import VueCookies from 'vue-cookies'
import moment from 'moment'

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

moment.locale('en');
Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(value).fromNow();
  }
})
//mixins
require('./mixins.js');


import App from './App.vue';

Vue.use(VueCookies)
Vue.use(VueApexCharts)
Vue.component('apexchart', VueApexCharts)

window.app = new Vue({
 router : router,
 render: h => h(App),
 methods : {
   
 }
}).$mount('#app');
