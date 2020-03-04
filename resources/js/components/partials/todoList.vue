<template>
    <div class="container">
        <ul>
            <li v-for="todoItem in todoItems" 
                :key="todoItem.id" :class="{ checked: todoItem.done }"> 
                <todoItem :item="todoItem" />
            </li>
            <li>
                <addItem />
            </li>
        </ul>
    </div>
</template>

<script>
    import AddItem from "./addItem.vue";
    import TodoItem from "./todoItem.vue";
    export default {
        name: 'todoList',
        computed: {
            todoItems() {
                return this.$store.state.todos;
            }
        }, 
        components: {
           'addItem' : AddItem, 
           'todoItem' : TodoItem
        },
        data() {
            return {
                sending: false
            }
        },
        methods: {
            // toggleCheck(todoItem) {
            //     todoItem.done = !todoItems.done;
            // }
            removeTodo(itemId) {
                let self = this;
                axios.delete(`/todoItem/${itemId}`)
                    .then(response => {
                        console.log(response.data);
                        this.$store.commit('todos', response.data);
                    }).catch(error => {
                        console.log(error)
                        this.$errors = error.reponse.data.errors; 
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
// import 
    ul {
        list-style: none;
        li {
            font-size: 30px;
            border-top: 1px solid red;
            border-bottom: 1px solid red;
        }
    }

</style>