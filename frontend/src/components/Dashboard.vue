<template>
    <div id="nav" class="home containerx bg-light">
        <h5 class="fw-bold">Bencana saat ini</h5>
        
        <ul class="list-group">
            <router-link to="/" class="list-group-item">Home</router-link>
            <router-link to="/" class="list-group-item">About</router-link>
        </ul>

        <button @click="$emit('halaman')">Back</button>
    </div>
</template>