<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminAccount'}">Back To List Admin Account</router-link>
        </nav>
        <hr>
        <form class="form" @submit.prevent="updateAdminAccount">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" v-model="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" v-model="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" v-model="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-control" v-model="role" required>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Account</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/admin'
export default {
    name:"UpdateAdminAccount",
    data(){
        return {
            name:'',
            username:'',
            password:'',
            role:'',
        }
    },
    created(){
        axios.get(`/admin/${this.$route.params.id}`).then(response => {
            this.name = response.data.name
            this.username = response.data.username
            this.role = response.data.role
        }).catch(e => {
            this.$router.push({name:'AdminAccount'})
        })
    },
    methods:{
        updateAdminAccount: function() {
            let formData = {
                name: this.name,
                username: this.username,
                role: this.role
            }
            if(this.password.trim() != ''){
                formData.password = this.password;
            }
            axios.post(`/admin/${this.$route.params.id}`, formData).then(response => {
                // this.$swal({
                //     icon: 'success',
                //     title: 'Success',
                //     text: response.data,
                // })
                alert(response.data)
            }).catch(response => {
                // this.$swal({
                //     icon: 'error',
                //     title: 'Oops...',
                //     text: response.response.data,
                // })
                alert(response.response.data)
            })
        }
    }
}
</script>