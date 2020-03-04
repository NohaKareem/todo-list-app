<template>
    <div class="container">
        <todoList/>
    </div>
</template>

<script>
    import TodoList from './partials/todoList';
    export default {
        name: 'app', 
        components: {
            TodoList
        }, 
        props: {
            todos: Array
        },
        mounted() {
            this.$store.commit('todos', this.todos);
        }
    }
</script>

<style lang="scss">

</style>