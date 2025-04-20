import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import { createPinia } from 'pinia';

// Configuration Axios
axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.withCredentials = true;

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(createPinia());

app.directive('focus', {
    mounted(el) {
        el.focus()
    }
})
app.mount('#app');