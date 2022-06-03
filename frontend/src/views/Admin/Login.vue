<template>
    <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
                <form @submit.prevent="login">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Your username" v-model="username" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                    in</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/admin'
export default {
    name:"AdminLogin",
    data(){
        return {
            username: '',
            password: '',
        }
    },
    methods:{
        login(){
            axios.post('/login', {
                username: this.username,
                password: this.password
            }).then(response => {
                localStorage.setItem('token-admin', response.data);
            }).catch(response => {
                alert(response.response.data)
            })
        }
    }
}
</script>