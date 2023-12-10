import Vue from 'vue';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import Home from './components/Home.vue';
Vue.use(Toast, {
    // Set options if needed
    timeout: 3000,
    position: 'top-right',
    // ... other options
  });
Vue.component('Home', Home);
const app = new Vue({
    el: '#app',
});