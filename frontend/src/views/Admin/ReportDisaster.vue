<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
        </nav>
        <hr>
        <div id="print">
            <h3 class="text-center mb-3">LAPORAN DATA BENCANA</h3>
            <data-table filter :rows="disaster" sn @loadData="getDisaster" :loading="loading" :query="query">
                <template #thead>
                    <table-head>DISASTER NAME</table-head>
                    <table-head>INFORMATION</table-head>
                    <table-head>LOCATION</table-head>
                </template>
                <template #tbody="{row}">
                    <table-body v-text="row.disaster_name"></table-body>
                    <table-body v-text="`${row.information}...`"></table-body>
                    <table-body v-text="row.location"></table-body>
                </template>
                <template #empty>
                    <TableBodyCell colspan="2">
                        Tidak ada hasil ditemukan
                    </TableBodyCell>
                </template>
            </data-table>
        </div>
        <input type="button" value="Cetak Laporan" class="btn btn-warning mt-3" @click="print('print')">
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
            disaster:[],
            pagination:{
                per_page:10
            },
            query:{},
        }
    },
    methods:{
        getDisaster: function ({page=1, per_page=15, search=''}){
            this.loading = true
            let isSearching = search ? `&search=${search}` : ''
            axios.get(`/disaster?page=${page}&per_page=${per_page}${isSearching}`).then(response => {
                if(response.data.data.length > 0){
                    this.disaster = response.data.data
                    this.pagination.page = response.data.current_page
                    this.pagination.total = response.data.total
                    this.pagination.per_page = 10
                    this.query.page = response.data.current_page
                    this.query.search = search ? search : ''
                }
                this.loading = false
            })
            
        },
        deleteDisaster: function(id){
            axios.delete(`/disaster/${id}`).then(response => {
                let index = this.disaster.findIndex(p => {
                    return p.id == id
                })
                this.disaster.splice(index, 1)
                alert(response.data)
            }).catch(response => {
                alert(response.response.data)
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