<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminCategory'}">Back To List Category</router-link>
        </nav>
        <hr>
        <form class="form" @submit.prevent="createCategory">
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" v-model="category">
            </div>
            <button type="submit" class="btn btn-success">Create Category</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/admin'
export default {
    name:"CreateCategory",
    data(){
        return {
            category:'',
        }
    },
    methods:{
        createCategory: function() {
            let formData = {
                category: this.category,
            }
            axios.post('/category', formData).then(response => {
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