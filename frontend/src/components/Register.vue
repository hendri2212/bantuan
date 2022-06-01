<template>
    <div id="nav" class="containerx bg-light">
        <h5 class="text-center fw-bold">Daftar Jadi Donatur</h5>
        <form @submit.prevent="save">
            <div class="mb-2">
                <label class="form-text">Full Name</label>
                <input type="text" v-model="name" class="form-control" placeholder="Type your name" required>
            </div>
            <div class="mb-2">
                <label class="form-text">Telephone</label>
                <input type="tel" v-model="telephone" class="form-control" placeholder="Type your phone number" required>
            </div>
            <div class="mb-2">
                <label class="form-text">Address</label>
                <textarea v-model="address" class="form-control" placeholder="Type your address" required></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <div class="btn-group">
                    <a href="/" class="btn btn-outline-secondary">Cancel</a>
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
            </div>
        </form>
        <p class="text-muted small fst-italic mt-5">
            * Sudah punya akun? Silahkan
            <router-link :to="{ name: 'Login' }" class="badge bg-success text-white text-decoration-none">Login</router-link>
        </p>
    </div>
</template>
<script>
export default {
    name: 'Disaster',
    data() {
        return {
            name        : '',
            telephone   : '',
            address     : ''
        }
    },
    methods: {
        save() {
            var data = {
                name        : this.name,
                telephone   : this.telephone,
                address     : this.address,
            }
            axios
            .post(this.$store.state.url + 'user', data)
            .then((response) => {
                localStorage.setItem("telephone", this.telephone)
                localStorage.setItem("user", response.data.id)
                this.$store.dispatch('login')
                this.$router.push({ name: 'Dashboard' })
            })

        }
    }
}
</script>