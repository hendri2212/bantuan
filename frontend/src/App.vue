<template>
    <div>
        <Header v-if="this.$router.name!='Admin'"></Header>
        <router-view/>
        <label class="fixed-bottom text-center form-text bg-white" v-if="$route.name!='Admin'">Powered by Hendri Arifin</label>
    </div>
</template>
<script>
    import Header from "@/components/Header.vue";
    export default {
        components: {
            Header
        }
    }
</script>
<style>
    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        /* text-align: center; */
        color: #2c3e50;
    }

    #nav {
        padding: 15px 15px 0 15px;
    }

    #nav a {
        font-weight: bold;
        color: #2c3e50;
    }

    #nav a.router-link-exact-active {
        color: #42b983;
    }

    .containerx {
        max-width : 460px;
        height    : 100vh;
        margin    : 0 auto;
    }


    .containery {
        max-width : 460px;
        margin    : 0 auto;
    }
</style>
