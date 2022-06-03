<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminCreateAdmin'}">Add Admin</router-link>
        </nav>
        <hr>
        <div>
            <data-table filter :rows="admin" :pagination="pagination" sn @loadData="getAdmin" :perPageOptions="[10, 20, 50]" :loading="loading" :query="query">
                <template #thead>
                    <table-head>NAME</table-head>
                    <table-head>USERNAME</table-head>
                    <!-- <table-head>PASSWORD</table-head> -->
                    <table-head>ROLE</table-head>
                    <table-head>ACTION</table-head>
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.name"></table-body>
                    <table-body v-text="row.username"></table-body>
                    <!-- <table-body v-text="row.password"></table-body> -->
                    <table-body v-text="row.role.toUpperCase()"></table-body>
                    <table-body>
                        <router-link :to="{name:'AdminUpdateAdmin', params:{id:row.id}}" class="btn btn-info">Edit</router-link>
                        <button @click="deleteAdminAccount(row.id)" class="btn btn-danger ms-2">Delete</button>
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
            url:'http://127.0.0.1:8000',
            loading: true,
            admin:[],
            pagination:{
                per_page:10
            },
            query:{},
        }
    },
    methods:{
        getAdmin: function ({page=1, per_page=15, search=''}){
            this.loading = true
            let isSearching = search ? `&search=${search}` : ''
            axios.get(this.url + `/api/admin/admin?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    this.admin = response.data.data
                    this.pagination.page = response.data.current_page
                    this.pagination.total = response.data.total
                    this.pagination.per_page = 10
                    this.query.page = response.data.current_page
                    this.query.search = search ? search : ''
                }
                this.loading = false
            })
            
        },
        deleteAdminAccount: function(id){
            axios.delete(`/admin/${id}`).then(response => {
                let index = this.admin.findIndex(p => {
                    return p.id == id
                })
                this.admin.splice(index, 1)
                alert(response.data)
            }).catch(response => {
                alert(response.response.data)
            })
        }
    },
}
</script>