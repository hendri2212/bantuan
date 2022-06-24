<template>
    <div id="nav" class="d-flex justify-content-between py-2 containery bg-light border-bottom align-items-center">
        <a href="/" class="fs-5 fw-bold text-primary text-decoration-none">e-Bantuan Bencana</a>
        <router-link :to="{ name: 'Register' }" v-if="token == null" class="btn btn-sm btn-outline-primary fw-light text-success">{{ btn1 }}</router-link>
        <button v-else class="btn btn-sm btn-outline-secondary" @click="logout">{{ btn2 }}</button>
    </div>
</template>
<script>
export default {
    name: 'Header',
    data() {
        return {
            btn1 : 'Daftar',
            btn2 : 'Keluar'
        }
    },
    computed:{
        token:function(){
            return this.$store.state.token
        }
    },
    methods: {
        async logout(){
            localStorage.removeItem('telephone');
            localStorage.clear();
            this.$store.dispatch('logout');
            this.$router.push({ name: 'Dashboard' });
        }
    }
}
</script>