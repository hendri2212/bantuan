<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminDisaster'}">Back To List Disaster</router-link>
        </nav>
        <hr>
        <form class="form" @submit.prevent="updateDisaster">
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
            <button type="submit" class="btn btn-success">Update Disaster</button>
        </form>
        <div class="d-flex mt-3">
            <div class="col-3" v-for="(data, index) in gambar" :key="index">
                <div style="min-height: 181px; max-height: 181px">
                    <img :src="data.url" class="img-fluid" style="max-height: 181px">
                </div>
            </div>
        </div>
        <input
            type="file"
            @change="onFileSelected"
            style="display: none"
            ref="fileInput"
        >
        <div class="btn-group mt-2">
            <button @click="$refs.fileInput.click()" class="btn btn-info btn-sm">Cari Gambar</button>
            <input type="button" value="upload" @click="onUpload" class="btn btn-primary btn-sm">
        </div>
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
            disaster_name   :'',
            date            :'',
            location        :'',
            information     :'',
            selectedFile    : null,
            gambar          : ''
        }
    },
    created(){
        axios.get(`/disaster/${this.$route.params.id}`).then(response => {
            this.disaster_name = response.data.disaster_name
            this.date = response.data.date
            this.location = response.data.location
            this.information = response.data.information
        }).catch(e => {
            this.$router.push({name:'AdminDisaster'})
        })

        axios.get(this.$store.state.url + 'tampil/'+ this.$route.params.id).then(response => {
            this.gambar = response.data
        }).catch(e => {
            console.log(e)
        })
    },
    methods:{
        updateDisaster: function() {
            let formData = {
                disaster_name: this.disaster_name,
                date: this.date,
                location: this.location,
                information: this.information
            }
            axios.post(`/disaster/${this.$route.params.id}`, formData).then(response => {
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
        },
        onFileSelected(event) {
            this.selectedFile = event.target.files[0]
        },
        onUpload() {
            let formData = new FormData()
            formData.append('image', this.selectedFile, this.selectedFile.name)
            axios.post('https://api.imgbb.com/1/upload?expiration=15552000&key=6106a7120cb6d336f105bf4e0be9e9bb',
                formData, {
                    onUploadProgress: uploadEvent => {
                        console.log('Upload Progress:' + Math.round(uploadEvent.loaded / uploadEvent.total * 100) + '%')
                    }
                }).then(response => {
                this.gambar = response.data.data.thumb.url
                axios
                .post(this.$store.state.url + 'image/',{ url: response.data.data.thumb.url, disaster_id: this.$route.params.id })
                .then(response => {
                    this.$router.go(this.$router.currentRoute)
                })
            }).catch(response => {
                console.log(response.response.data)
            })
        }
    }
}
</script>