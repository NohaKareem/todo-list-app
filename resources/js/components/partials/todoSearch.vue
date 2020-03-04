<template>
    <div class="container">
        <input type="text" name="searchStr" id="searchStr" placeholder="search for todo here" @keyup="searchTodos()">
        <i class="fa fa-search" aria-hidden="true"></i>
        <ul>
            <li v-for="todoItem in todoItems" 
                :key="todoItem.id" :class="{ checked: todoItem.done }"> 
                <todoItem :item="todoItem" />
            </li>
        </ul>
    </div>
</template>

<script>
    import TodoItem from "./todoItem.vue";
    export default {
        name: 'todoSearch',
        computed: {
            todoItems() {
                return this.$store.state.todos;
            }
        }, 
        components: {
           'todoItem' : TodoItem
        },
        data() {
            return {
                sending: false, 
                searchStr: ""
            }
        },
        methods: {
            searchTodos() {
                let self = this;
                this.searchStr = document.querySelector('#searchStr');
                axios.get(`/todoItem/search/${this.searchStr}`)
                    .then(response => {
                        console.log(response.data);
                        this.$store.commit('todos', JSON.parse(response.data));
                    }).catch(error => {
                        console.log(error)
                        this.$errors = error.reponse.data.errors; 
                    });
            }
        }
    }
</script>

<style lang="scss" >
    input[type=text], .fa-search {
        font-size: 30px;
    }
    #searchStr {
        margin-left: 40px;
        width: 85%;
    }
    .fa-search {
        margin-left: 10px;
    }
</style>