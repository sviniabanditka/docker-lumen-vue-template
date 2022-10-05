<template>
    <div id="app">
        <NavBar />
        <router-view/>
    </div>
</template>

<script>
// @ is an alias to /src
import NavBar from '@/components/layout/NavBar.vue'

export default {
    components: {
        NavBar
    }
}
</script>

<style scoped>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
}
</style>