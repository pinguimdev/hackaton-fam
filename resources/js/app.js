import Vue from 'vue'
import App from './components/App'

import Vuetify from "vuetify";
import router from './router'

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

Vue.use(Vuetify)

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    vuetify: new Vuetify(),
    router
});
