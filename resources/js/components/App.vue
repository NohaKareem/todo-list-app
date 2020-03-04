<template>
    <div class="container">
        <todoSearch/>
        <todoList/>
    </div>
</template>

<script>
    import TodoList from './partials/todoList';
    import TodoSearch from './partials/todoSearch';
    export default {
        name: 'app', 
        components: {
            TodoList, TodoSearch
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