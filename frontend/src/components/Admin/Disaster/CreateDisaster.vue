<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminDisaster'}">Back To List Disaster</router-link>
        </nav>
        <hr>
        <form class="form" @submit.prevent="createDisaster">
            <div class="mb-3">
                <label class="form-label">Disaster</label>
                <input type="text" class="form-control" v-model="disaster_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" v-model="date">
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" v-model="location">
            </div>
            <div class="mb-3">
                <label class="form-label">Information</label>
                <textarea class="form-control" v-model="information" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create Disaster</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/admin'
axios.defaults.params = {}
axios.defaults.params['token'] = localStorage.getItem('token-admin')
export default {
    name:"CreateDisaster",
    data(){
        return {
            disaster_name:'',
            date:'',
            location:'',
            information:'',
        }
    },
    methods:{
        createDisaster: function() {
            let formData = {
                disaster_name: this.disaster_name,
                date: this.date,
                location: this.location,
                information: this.information
            }
            axios.post('/disaster', formData).then(response => {
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