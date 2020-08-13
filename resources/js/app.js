require('./bootstrap');

window.Vue = require('vue');

import VueNumberInput from '@chenfengyuan/vue-number-input';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('add-session-component', require('./components/session/AddSessionComponent.vue').default);


//plugins
Vue.component('number-input', VueNumberInput);
Vue.component('v-select', vSelect);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
