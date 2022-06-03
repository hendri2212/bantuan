<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminAccount'}">Back To List Admin Account</router-link>
        </nav>
        <hr>
        <form class="form" @submit.prevent="createAdminAccount">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" v-model="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" v-model="username">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" v-model="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-control" v-model="role">
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create Account</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/admin'
export default {
    name:"CreateAdminAccount",
    data(){
        return {
            name:'',
            username:'',
            password:'',
            role:'',
        }
    },
    methods:{
        createAdminAccount: function() {
            let formData = {
                name: this.name,
                username: this.username,
                password: this.password,
                role: this.role
            }
            axios.post('/admin', formData).then(response => {
                alert(response.data)
                // this.$swal({
                //     icon: 'success',
                //     title: 'Success',
                //     text: response.data,
                // })
            }).catch(response => {
                alert(response.response.data)
                // this.$swal({
                //     icon: 'error',
                //     title: 'Oops...',
                //     text: response.data,
                // })
            })
        }
    }
}
</script>