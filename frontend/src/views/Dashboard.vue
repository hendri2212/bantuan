<template>
    <div id="nav" class="home containerx bg-light">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/banner-bansos.jpeg" class="d-block w-100" alt="Banner Bencana">
                </div>
            </div>
        </div>
    
        <h5 class="fw-bold mt-4">Bencana saat ini</h5>
        
        <ul class="list-group">
            <router-link to="/" class="list-group-item">Home</router-link>
            <router-link to="/about" class="list-group-item">About</router-link>
            <router-link :to="{ name: 'Disaster' }" class="list-group-item">Kebakaran Rumah</router-link>
        </ul>
    </div>
</template>
