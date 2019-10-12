import Vue from 'vue';
import ElementUI from 'element-ui';
import App from './App.vue';

Vue.use(ElementUI);

export default function Application(element = null, data = null) {
    new Vue({
        el: '#app',
        render: h => h(App)
    });
}
