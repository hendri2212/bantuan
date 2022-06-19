<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <!-- <router-link class="btn btn-primary" :to="{name:'AdminCreateProducts'}">Add Product</router-link> -->
        </nav>
        <hr>
        <div id="print">
            <h3 class="text-center mb-3">LAPORAN DATA BARANG</h3>
            <!-- <data-table filter :rows="products" :pagination="pagination" sn @loadData="getProducts" :perPageOptions="[10, 20, 50]" :loading="loading" :query="query"> -->
            <data-table filter :rows="products" sn @loadData="getProducts" :loading="loading" :query="query">
                <template #thead>
                    <table-head>USER</table-head>
                    <table-head>DISASTER</table-head>
                    <table-head>PRODUCT</table-head>
                    <table-head>TOTAL</table-head>
                    <!-- <table-head>ACTION</table-head> -->
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.user.name"></table-body>
                    <table-body v-text="row.disaster.disaster_name"></table-body>
                    <table-body v-text="row.product"></table-body>
                    <table-body v-text="row.total"></table-body>
                    <!-- <table-body>
                        <button class="btn btn-info">Edit</button>
                        <button class="btn btn-danger ms-2">Delete</button>
                    </table-body> -->
                </template>
                <template #empty>
                    <TableBodyCell colspan="2">
                        Tidak ada hasil ditemukan
                    </TableBodyCell>
                </template>
            </data-table>
        </div>
        <input type="button" value="Cetak Laporan" class="btn btn-warning mt-3 float-end" @click="print('print')">
    </div>
</template>
<script>
import axios from 'axios'
import { DataTable, TableHead, TableBody, TableBodyCell} from '@jobinsjp/vue3-datatable'
export default {
    name: "Disaster",
    components:{
        DataTable,
        TableHead,
        TableBody,
        TableBodyCell,
    },
    data(){
        return {
            url:'http://127.0.0.1:8000',
            loading: true,
            products:[],
            pagination:{
                per_page:10
            },
            query:{},
        }
    },
    methods:{
        getProducts: function ({page=1, per_page=15, search=''}){
            this.loading = true
            let isSearching = search ? `&search=${search}` : ''
            axios.get(this.url + `/api/admin/products?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    this.products = response.data.data
                    this.pagination.page = response.data.current_page
                    this.pagination.total = response.data.total
                    this.pagination.per_page = 10
                    this.query.page = response.data.current_page
                    this.query.search = search ? search : ''
                }
                this.loading = false
            })
            
        },
        print: function(id){
            var printContents = document.getElementById(id).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    },
}
</script>