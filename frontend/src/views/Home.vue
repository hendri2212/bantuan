<template>
  <div id="nav" class="home containerx bg-light">
    <!--div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../assets/banner-bansos.jpeg" class="d-block w-100" alt="Banner Bencana">
        </div>
      </div>
    </div-->
    
    <!--h5 class="fw-bold mt-4">Bencana saat ini</h5-->
    
    <!--ul class="list-group">
      <router-link to="/" class="list-group-item">Home</router-link>
      <router-link to="/about" class="list-group-item">About</router-link>
      <router-link :to="{ name: 'disaster' }" class="list-group-item">Donation</router-link>
    </ul-->
    <!--HelloWorld v-if="page=='HelloWorld'" @halaman="pages()"></HelloWorld>
    <Dashboard v-if="page=='Dashboard'" @halaman="pages()"></Dashboard-->
    <component :is="page" @halaman="pages()"></component>
  </div>
</template>

<script>
import HelloWorld from '@/components/HelloWorld.vue'
import Dashboard from '@/components/Dashboard.vue'

export default {
  name: 'Home',
  components: {
    HelloWorld,
    Dashboard
  },
  data() {
    return {
      page: "HelloWorld"
    }
  },
  methods: {
    pages() {
      if(this.page=="HelloWorld"){
        this.page="Dashboard"
      } else {
        this.page="HelloWorld"
      }
    }
  }
}
</script>