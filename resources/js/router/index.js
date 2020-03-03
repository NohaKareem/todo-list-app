import Vue from 'vue';
import Router from 'vue-router';
import TodoList from '../components/partials/todoList';
import AddItem from '../components/partials/addItem';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "*",
            redirect: '/'
        },
        {
            path: '/',
            name: 'todoList', 
            component: TodoList
        }, 
        {
            path: '/add',
            name: 'addItem', 
            component: AddItem
        }
    ]
})