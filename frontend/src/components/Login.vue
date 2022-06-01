<template>
    <div id="nav" class="containerx bg-light">
        <h5 class="text-center fw-bold">Login ke Aplikasi</h5>
        <form @submit.prevent="login">
            <div class="mb-2">
                <label class="form-text">Telephone</label>
                <input type="tel" class="form-control form-control-lg" v-model="telephone" placeholder="Type your phone number">
                <label class="small fst-italic text-muted">* Kode OTP akan dikirim ke nomor handphone</label>
            </div>

            <!-- <div class="mb-2">
                <label class="form-text">Password</label>
                <input type="password" class="form-control" placeholder="Type your password">
            </div> -->
            <div class="d-flex justify-content-end">
                <div class="btn-group">
                    <a href="/" class="btn btn-outline-secondary btn-sm">Cancel</a>
                    <input type="submit" value="Login" class="btn btn-sm btn-primary">
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
        }
    },
    methods: {
        login() {
            axios
            .get(this.$store.state.url + 'profile/'+this.telephone)
            .then(response => {
                if (response.data.telephone != null) {
                    localStorage.setItem("telephone", response.data.telephone)
                    localStorage.setItem("user", response.data.id)
                    this.$store.dispatch('login')
                    this.$router.push({ name: 'Dashboard' })
                } else {
                    alert('Nomor telepon tidak terdaftar')
                }
            })
        }
    }
}
</script>