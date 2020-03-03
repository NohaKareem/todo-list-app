require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
 
import App from './components/App';
import router from './router';
 
Vue.use(Vuex);
 
const store = new Vuex.Store({
    state: {
        todos: null
    }, 
    mutations: {
        // user(state, payload) {
        //     state.user = payload;
        // }, 
        todos(state, payload) {
            state.todos = payload;
        }
    }
});
 
new Vue ({
    el: '#app',
    router, 
    store, 
    components: { App }
});