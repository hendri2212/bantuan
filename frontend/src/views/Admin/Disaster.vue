<template>
    <div class="container-fluid shadow bg-white" style="margin-left: 10px">
        <nav class="navbar navbar-light pt-3 pb-0">
            <span class="fs-4">{{ $route.meta.title }}</span>
        </nav>
        <hr>
        <v-server-table :columns="columns" :url="`${url}/api/admin/disaster`"></v-server-table>
    </div>
</template>
<script>
export default {
    name: "Disaster",
    data(){
        return {
            url:'http://127.0.0.1:8000',
            columns: ['ID', 'Disaster Name', 'Information', 'Location']
        }
    }
}
</script>