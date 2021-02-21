/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



require('vue2-animate/dist/vue2-animate.min.css');
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-select/dist/vue-select.css'
import 'primevue/resources/themes/saga-blue/theme.css'    //theme
import 'primevue/resources/primevue.min.css'                 //core css
import ToastService from 'primevue/toastservice';


Vue.use(ToastService);
import { BootstrapVue} from 'bootstrap-vue'
Vue.use(BootstrapVue)
import { BootstrapVueIcons } from 'bootstrap-vue'
Vue.use(BootstrapVueIcons)
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

var JsBarcode = require('jsbarcode')



//CARGAMOS CADA COMPONENTES
import VueProgressBar from 'vue-progressbar'
 
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '25px'
  })

////////////////////////////COMPONENTE RAIZ///////////////////////
Vue.component('notificacion', require('./components/Notificacion.vue'));
/////////////////////////////////////////////////////////////////


//IMPORTAMOS EL ARCHIVO ROUTER
import router from './routes';
import "./convertidor";




const app = new Vue({
    el: '#app',
    router
});
