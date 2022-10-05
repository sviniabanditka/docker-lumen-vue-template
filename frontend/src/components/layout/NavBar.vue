<template>
    <div id="nav">
        <router-link to="/">Home</router-link> |
        <router-link to="/projects">Projects</router-link> |
        <span v-if="isLoggedIn">
            <a @click="logout">Logout</a>
        </span>
        <span v-else>
            <router-link to="/register">Register</router-link> |
            <router-link to="/login">Login</router-link>
        </span>
</div>
</template>

<script>
export default {
    name: 'NavBar',
    computed : {
        isLoggedIn : function(){ 
            return this.$store.getters.isAuthenticated
        }
    },
    methods: {
        async logout (){
            await this.$store.dispatch('logout')
            this.$router.push('/login')
        }
    },
}
</script>

<style scoped>
#nav {
    padding: 30px;
}
#nav a {
    font-weight: bold;
    color: #000;
}
a:hover {
    cursor: pointer;
}
#nav a.router-link-exact-active {
    color: #00d;
}
</style>