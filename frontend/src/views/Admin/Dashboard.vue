<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0">
            <span class="fs-4">{{ $route.meta.title }}</span>
        </nav>
        <hr>
        <div class="d-flex">
            <div class="card text-bg-danger mb-3" style="width: 15rem;">
                <div class="card-header">Bencana</div>
                <div class="card-body text-center">
                    <h5 class="card-title text-nowrap">Jumlah Bencana</h5>
                    <p class="card-text fs-1">{{ DisasterTotal }}</p>
                </div>
            </div>
            <div class="card text-bg-warning mb-3 mx-2" style="width: 15rem;">
                <div class="card-header">Penyumbang</div>
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Penyumbang</h5>
                    <p class="card-text fs-1">{{ UserTotal }}</p>
                </div>
            </div>
            <div class="card text-bg-success mb-3" style="width: 15rem;">
                <div class="card-header">Barang</div>
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Barang</h5>
                    <p class="card-text fs-1">{{ ProductTotal }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            DisasterTotal: 0,
            ProductTotal: 0,
            UserTotal: 0
        }
    },
    created() {
        axios
        .get(this.$store.state.url + 'count')
        .then(response => {
            this.DisasterTotal = response.data
        })

        axios
        .get(this.$store.state.url + 'product')
        .then(response => {
            this.ProductTotal = response.data
        })

        axios
        .get(this.$store.state.url + 'user')
        .then(response => {
            this.UserTotal = response.data
        })
    }
}
</script>