<template>
    <div id="nav" class="home containerx bg-light">
        <div class="d-flex justify-content-between">
            <h5 class="fw-bold">Kebakaran Rumah</h5>
            <router-link to="/"><span class="badge bg-warning text-dark">Close</span></router-link>
        </div>
        <div class="card">
            <div class="card-body">
                <span class="bg-light border-bottom border-1 border-warning mb-1">Information</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quisquam magnam, aut veniam, ipsa delectus doloribus suscipit perferendis ullam quasi quam soluta alias libero porro. Facilis, nobis! Fugiat, odio ipsa.</p>
                <span class="bg-light border-bottom border-1 border-warning mb-1">Location</span>
                <p>Kabupaten Kotabaru</p>
                <span class="bg-light border-bottom border-1 border-warning mb-1">Date</span>
                <p>Sunday, 03 April 2022</p>
            </div>
        </div>
        
        <h5 class="fw-bold mt-5">Data Penyumbang</h5>

        <form>
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label>Telephone</label>
                <input type="number" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <router-link :to="{ name:'Product'}" class="btn btn-primary text-white">Next</router-link>
        </form>
    </div>
</template>