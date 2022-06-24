<template>
    <div id="nav" class="home containerx bg-light">
        <div class="d-flex justify-content-between">
            <h5 class="fw-bold">Data Barang</h5>
            <router-link to="/"><span class="badge bg-warning text-dark">Tutup</span></router-link>
        </div>
        <form v-on:submit.prevent="save">
            <div class="mb-2">
                <label class="form-text">Jenis Barang</label>
                <select v-model="category" class="form-select">
                    <option disabled value="">Pilih salah satu</option>
                    <option :value="data.id" v-for="(data, index) in categories" :key="index">{{ data.category }}</option>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-text">Nama Barang</label>
                <input type="text" class="form-control" v-model="product">
            </div>
            <div class="mb-2">
                <label class="form-text">Jumlah</label>
                <input type="text" class="form-control" v-model="total">
            </div>
            <div class="d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="Tambah">
            </div>
        </form>
        <table class="table mt-5">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Jenis Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="products==null">
                    <td colspan="4" class="text-center py-5">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
                <tr v-for="(data, index) in products" :key="index" v-else>
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ data.category.category }}</td>
                    <td>{{ data.product }}</td>
                    <td>{{ data.total }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="d-grid">
            <a href="/" class="btn btn-outline-secondary btn-block fw-lighter">Selesai</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            categories  : null,
            products    : null,

            product     : '',
            total       : '',
            category    : ''
        }
    },
    created() {
        axios
        .get(this.$store.state.url + 'categories')
        .then(response => {
            this.categories = response.data
        })
        
        axios
        .get(this.$store.state.url + `products?user_id=${ localStorage.user }&disaster_id=${ this.$route.params.id }`)
        .then(response => {
            this.products = response.data
        })
    },
    methods: {
        save() {
            var data = {
                product     : this.product,
                total       : this.total,
                user_id     : localStorage.user,
                disaster_id : this.$route.params.id,
                category_id : this.category
            }
            axios
            .post(this.$store.state.url + 'product', data)
            .then(
                this.$router.push({ name: 'Product' }),
                this.$router.go(this.$router.currentRoute)
            )
        }
    }
}
</script>