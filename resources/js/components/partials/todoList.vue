<template>
    <div class="container">
        <ul>
            <li v-for="todoItem in todoItems" :key="todoItem.id" :class="{ checked: todoItem.done }">
                <input type="checkbox" checked v-if="todoItem.done"> 
                <input type="checkbox" v-else>
                <!-- @click="toggleCheck(todoItem)" -->
                {{ todoItem.item }}
            </li>
            <li>
                <form action="/todoItem" ref="addTodoForm" method="post">
                    <input type="text" name="item" placeholder="add to do">
                    <button class="btn btn-success" id="addTodoButton" @click="addTodo">+</button>
                </form>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'todoList',
        computed: {
            todoItems() {
                return this.$store.state.todos;
            }
        }, 
        methods: {
            // toggleCheck(todoItem) {
            //     todoItem.done = !todoItems.done;
            // }
            addTodo(){
                const formData = new FormData(this.$refs.addTodoForm);
                console.log(formData)
                let self = this;
                axios.post(`/todoItem`, formData)
                    .then(response => {
                        console.log(response.data);
                        this.$store.commit('todos', response.data);//~~
                    }).catch(error => {
                        console.log(error)
                        this.$errors = error.reponse.data.errors; 
                    });
                    // .then(() => {
                    //     self.uploading = false; 
                    // });
            }
        }
    }
</script>

<style lang="scss" scoped>
// import~
    ul {
        list-style: none;
        li {
            font-size: 30px;
            border-top: 1px solid red;
            border-bottom: 1px solid red;
        }
    }

    .checked {
        text-decoration: line-through;
    }

    input[type=text] {
        width: 90%;
        border: none;
        display: inline-block;
    }

    #addTodoButton {
        display: inline !important;
    }

    // checkbox styling based from https://stackoverflow.com/a/57024223/1446598
    input[type=checkbox] {
        -webkit-appearance: none;
        -moz-appearance: none;
        vertical-align: middle;//center;//
        width: 30px; 
        height: 30px;
        font-size: 30px;
        border-radius: 10px;
        margin-top: -5px;
        // margin-right: 20px !important;
        border: solid 1px black;
        background-color: white;
    }

    input[type=checkbox]:checked:after {
        vertical-align: middle;
        position: relative;
        bottom: 5px;
        left: 3px;
        top: -10px;
        color: green;
        content: "\2713"; /* check mark */
    }

    .unChecked {
        background-color: white;
    }
</style>