<template>
    <div class="shadow bg-white">
        <nav class="navbar navbar-light pt-3 pb-0 d-flex justify-content-between">
            <span class="fs-4">{{ $route.meta.title }}</span>
            <router-link class="btn btn-primary" :to="{name:'AdminDisaster'}">Back To List Disaster</router-link>
        </nav>
        <hr>
        <form class="form">
            
        </form>
    </div>
</template>