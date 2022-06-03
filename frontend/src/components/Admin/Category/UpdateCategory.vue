<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminCategory'}">Back To List Category</router-link>
        </nav>
        <hr>
        <form class="form" @submit.prevent="updateCategory">
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" v-model="category">
            </div>
            <button type="submit" class="btn btn-success">Update Category</button>
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
    created(){
        axios.get(`/category/${this.$route.params.id}`).then(response => {
            this.category = response.data.category
        }).catch(e => {
            this.$router.push({name:'AdminCategory'})
        })
    },  
    methods:{
        updateCategory: function() {
            let formData = {
                category: this.category,
            }
            axios.post(`/category/${this.$route.params.id}`, formData).then(response => {
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
                //     text: response.response.data,
                // })
            })
        }
    }
}
</script>