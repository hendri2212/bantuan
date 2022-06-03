<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminCreateCategory'}">Add Category</router-link>
        </nav>
        <hr>
        <div>
            <data-table filter :rows="category" :pagination="pagination" sn @loadData="getCategory" :perPageOptions="[10, 20, 50]" :loading="loading" :query="query">
                <template #thead>
                    <table-head>CATEGORY</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.category"></table-body>
                    <table-body>
                        <router-link :to="{name:'AdminUpdateCategory', params:{id:row.id}}" class="btn btn-info">Edit</router-link>
                        <button @click="deleteCategory(row.id)" class="btn btn-danger ms-2">Delete</button>
                    </table-body>
                </template>
                <template #empty>
                    <TableBodyCell colspan="2">
                        Tidak ada hasil ditemukan
                    </TableBodyCell>
                </template>
            </data-table>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/admin'
import { DataTable, TableHead, TableBody, TableBodyCell } from '@jobinsjp/vue3-datatable'
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
            loading: true,
            category:[],
            pagination:{
                per_page:10
            },
            query:{},
        }
    },
    methods:{
        getCategory: function ({page=1, per_page=15, search=''}){
            this.loading = true
            let isSearching = search ? `&search=${search}` : ''
            axios.get(`/category?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    this.category = response.data.data
                    this.pagination.page = response.data.current_page
                    this.pagination.total = response.data.total
                    this.pagination.per_page = 10
                    this.query.page = response.data.current_page
                    this.query.search = search ? search : ''
                }
                this.loading = false
            })
            
        },
        deleteCategory: function(id){
            axios.delete(`/category/${id}`).then(response => {
                let index = this.category.findIndex(p => {
                    return p.id == id
                })
                this.category.splice(index, 1)
                alert(response.data)
            }).catch(response => {
                alert(response.response.data)
            })
        }
    },
}
</script>