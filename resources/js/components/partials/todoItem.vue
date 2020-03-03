<template>
    <form action="/todoItem" method="post" enctype="multipart/form-data">
        <input type="checkbox" checked v-if="item.done"> 
        <input type="checkbox" v-else>
        <!-- @click="toggleCheck(item)" -->
        {{ item.item }}
        <i class="fa fa-trash" aria-hidden="true" @click="removeTodo(item.id)"></i>
    </form>
</template>

<script>
    export default {
        name: 'todoItem',
        props: ['item'],
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
    .checked {
        text-decoration: line-through;
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

    // delete
    .fa-trash {
        cursor: pointer;
    }
    .fa-trash:hover {
        color: red;
    }
</style>