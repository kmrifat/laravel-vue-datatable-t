import '../bootstrap.js'
import Vue from 'vue'
import HistoryApp from "./layouts/HistoryApp";

import VueRouter from 'vue-router';
import HistoryTableComponent from "./HistoryTableComponent";
import moment from "moment";

Vue.use(VueRouter);


Vue.component('pagination', require('laravel-vue-pagination'));


Vue.filter('dateTime', function (value) {
    return moment(value).format('dddd, DD-MMM-YYYY H:mm a')
});

const routes = [
    {path: '/', component: HistoryTableComponent, name: 'history'},
];

const router = new VueRouter({
    // mode: 'history',
    routes // short for `routes: routes`
});

new Vue({
    router,
    components: {historyapp: HistoryApp}
}).$mount('#app');
