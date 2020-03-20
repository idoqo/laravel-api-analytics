require('./bootstrap');

window.Vue = require('vue');

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);

const app = new Vue({
    el: '#app',
});
