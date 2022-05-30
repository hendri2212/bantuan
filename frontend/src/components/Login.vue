<template>
    <div id="nav" class="containerx bg-light">
        <h5 class="text-center fw-bold">Login ke Aplikasi</h5>
        <form @submit.prevent="save">
            <div class="mb-2">
                <label class="form-text">Telephone</label>
                <input type="tel" class="form-control" placeholder="Type your phone number">
            </div>
            <div class="mb-2">
                <label class="form-text">Password</label>
                <input type="password" class="form-control" placeholder="Type your password">
            </div>
            <div class="d-flex justify-content-end">
                <div class="btn-group">
                    <a href="/" class="btn btn-outline-secondary">Cancel</a>
                    <input type="submit" value="Login" class="btn btn-primary">
                    <!-- <router-link :to="{ name:'Product'}" class="btn btn-primary text-white fw-normal">Next</router-link> -->
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: 'Login',
    data() {
        return {
            telephone   : '',
            password    : ''
        }
    },
    methods: {
        save() {
            // var data = {
            //     telephone   : this.telephone,
            //     password    : this.password,
            // }
            // axios
            // .post(this.$store.state.url + 'login', data)
            // .then(response => {
            //     localStorage.setItem("telephone", this.telephone)
            //     this.$router.push({ name: 'Dashboard' })
            // })
            localStorage.setItem("telephone", '085746080544')
            this.$router.push({ name: 'Dashboard' })
        }
    }
}
</script>