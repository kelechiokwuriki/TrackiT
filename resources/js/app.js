require('./bootstrap');

window.Vue = require('vue');

import VueNumberInput from '@chenfengyuan/vue-number-input';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import Vue from 'vue'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'


Vue.component('add-session-component', require('./components/session/AddSession.vue').default);
Vue.component('edit-session-component', require('./components/session/EditSession.vue').default);
Vue.component('dashboard-component', require('./components/Dashboard/Dashboard.vue').default);
Vue.component('my-sessions-component', require('./components/session/MySessions.vue').default);
Vue.component('view-my-session-component', require('./components/session/ViewMySession.vue').default);


//modules
Vue.component('status-component', require('./components/modules/Status.vue').default);
Vue.component('edit-exercise-modal-component', require('./components/modules/EditExerciseModal.vue').default);
Vue.component('chart-component', require('./components/modules/Charts.vue').default);


//plugins
Vue.component('number-input', VueNumberInput);
Vue.component('v-select', vSelect);


Vue.use(Chartkick.use(Chart))


window.eventBus = new Vue({});



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
