<template>
    <form action="/todoItem" ref="addTodoForm" method="post" enctype="multipart/form-data">
        <input type="text" name="item" placeholder="add to do">
        <button type="button" class="btn btn-success" id="addTodoButton" @click="addTodo()" :disabled = "sending">
            {{ sending ? 'adding...' : '+' }}
        </button>
    </form>
</template>

<script>
    export default {
        name: 'addItem',
        computed: {
            todoItems() {
                return this.$store.state.todos;
            }
        }, 
        data() {
            return {
                sending: false
            }
        },
        methods: {
            addTodo() {
                const formData = new FormData(this.$refs.addTodoForm);
                console.log(formData)
                this.sending = true;
                let self = this;
                axios.post(`/todoItem`, formData)
                    .then(response => {
                        console.log(response.data);
                        this.$store.commit('todos', response.data);
                    }).catch(error => {
                        console.error(error)
                        this.$errors = error.reponse.data.errors; 
                    }).then(() => {
                        self.sending = false;
                    });
            }
        }
    }
</script>

<style lang="scss">
    input[type=text] {
        // width: 90%;
        border: none;
        display: inline-block;
    }

    #addTodoButton {
        display: inline !important;
    }
</style>