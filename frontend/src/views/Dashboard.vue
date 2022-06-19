<template>
    <div id="nav" class="containerx bg-light">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" v-for="(data, index) in gambar" :key="index">
                    <!-- <img src="../assets/banner-development.png" class="d-block w-100" alt="Banner Bencana"> -->
                    <img :src="data.url" class="d-block w-100" alt="Banner Bencana">
                </div>
            </div>
        </div>
    
        <h5 class="fw-bold mt-4">Bencana saat ini</h5>
        <div class="d-flex justify-content-center m-5" v-if="disaster==null">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <ul class="list-group" v-for="(data, index) in disaster" :key="index" v-else>
            <router-link :to="{ name: 'Disaster', params: { id: data.id } }" class="list-group-item mb-2">{{ data.disaster_name }}</router-link>
        </ul>
    </div>
</template>
<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            disaster: null,
            gambar  : null
        }
    },
    created() {
        axios
        .get(this.$store.state.url + 'disaster')
        .then(response => {
            this.disaster = response.data
        })

        axios.get(this.$store.state.url + 'image').then(response => {
            this.gambar = response.data
        }).catch(e => {
            console.log(e)
        })
    }
}
</script>