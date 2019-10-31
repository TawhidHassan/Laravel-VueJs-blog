require('./bootstrap');

window.Vue = require('vue');

//vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//vue router

// v-from
import { Form, HasError, AlertError } from 'vform'
window.Form =Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//sweetAleart2
// ES6 Modules or TypeScript
import Swal from 'sweetalert2'

window.Swal=Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast=Toast;

// vuex for data comunication to one component to another component
import Vuex from 'vuex'
Vue.use(Vuex)

import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
)

//vue component
import {routes} from "./routes";
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('adminhome', require('./components/admin/AdminMaster'));
Vue.component('home-main', require('./components/public/PublicMaster'));



// keep it simple for now.
const router = new VueRouter({
    routes, // short for `routes: routes`
    mode:'hash'
})

//support moment js
import {filter} from './filter'

//markdown editor
import 'v-markdown-editor/dist/index.css';
import Editor from 'v-markdown-editor'
Vue.use(Editor);


const app = new Vue({
    el: '#app',
    router,
    store
});
