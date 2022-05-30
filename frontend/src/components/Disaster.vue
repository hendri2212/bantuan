<template>
    <div id="nav" class="home containerx bg-light">
        <div class="d-flex justify-content-between">
            <p class="placeholder-glow" v-if="disaster==null">
                <!-- <span class="placeholder bg-secondary text-secondary col-6"></span> -->
                <span class="placeholder bg-secondary text-secondary">Lorem ipsum dolor sit amet consectetur.</span>
            </p>
            <!-- <h5 class="fw-bold" v-else>{{ disaster.disaster_name }}</h5> -->
            <h5 class="fw-bold" v-else>Data Disaster</h5>
            <router-link to="/"><span class="badge bg-warning text-dark">Close</span></router-link>
        </div>
        <div class="card">
            <div class="card-body">
                <span class="bg-light border-bottom border-1 border-warning mb-1">Disaster</span>
                <p class="placeholder-glow" v-if="disaster==null">
                    <span class="placeholder bg-secondary col-4"></span>
                </p>
                <p v-else>{{ disaster.disaster_name }}</p>
                <span class="bg-light border-bottom border-1 border-warning mb-1">Information</span>
                <p class="placeholder-glow" v-if="disaster==null">
                    <span class="placeholder bg-secondary col-10"></span>
                    <span class="placeholder bg-secondary col-8"></span>
                    <span class="placeholder bg-secondary col-6"></span>
                </p>
                <p v-else>{{ disaster.information }}</p>
                <span class="bg-light border-bottom border-1 border-warning mb-1">Location</span>
                <p class="placeholder-glow" v-if="disaster==null">
                    <span class="placeholder bg-secondary col-4"></span>
                </p>
                <p v-else>{{ disaster.location }}</p>
                <span class="bg-light border-bottom border-1 border-warning mb-1">Date</span>
                <p class="placeholder-glow" v-if="disaster==null">
                    <span class="placeholder bg-secondary col-4"></span>
                </p>
                <p v-else>{{ disaster.date }}</p>
            </div>
        </div>
        
        <h5 class="fw-bold mt-5">Profil User</h5>
        <!-- <h5 class="fw-bold mt-5">{{ this.$route.params.id }}</h5> -->
        <div class="card" v-if="this.$store.state.token == null">
            <div class="card-body">
                <h4 class="text-center text-muted">Silahkan register / login terlebih dahulu untuk melakukan sumbangan atau donasi</h4>
            </div>
        </div>
        <div class="card" v-else>
            <div class="card-body">
                <div class="mb-2">
                    <label class="form-text">Full Name</label>
                    <h6>{{ profile.name }}</h6>
                </div>
                <div class="mb-2">
                    <label class="form-text">Telephone</label>
                    <h6>{{ profile.telephone }}</h6>
                </div>
                <div class="mb-2">
                    <label class="form-text">Address</label>
                    <h6>{{ profile.address }}</h6>
                </div>
                <div class="d-flex justify-content-end pt-3">
                    <router-link :to="{ name: 'Product' }" class="btn btn-primary text-white fw-light">Menyumbang</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Disaster',
    data() {
        return {
            disaster    : null,
            profile     : ''
        }
    },
    created() {
        axios
        .get(this.$store.state.url + 'disaster/' + this.$route.params.id + '/edit')
        .then(response => {
            this.disaster = response.data
        })
        
        axios
        // .get(this.$store.state.url + 'user/' + this.$store.state.telephone)
        .get(this.$store.state.url + 'profile/' + this.$store.state.token)
        .then(response => {
            this.profile = response.data
            // console.log(response.data)
        })
    }
}
</script>