<template>
    <div id="nav" class="home containerx bg-light">
        <div class="d-flex justify-content-between">
            <h5 class="fw-bold">Data Barang</h5>
            <router-link to="/"><span class="badge bg-warning text-dark">Close</span></router-link>
        </div>
        <form v-on:submit.prevent="addNewTodo">
            <div class="mb-3">
                <label>Product Category</label>
                <select v-model="category" class="form-select">
                    <option>Food</option>
                    <option>Clothing</option>
                    <option>Disabled select</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" class="form-control" v-model="product">
            </div>
            <div class="mb-3">
                <label>Total</label>
                <input type="text" class="form-control" v-model="total">
            </div>
            <input type="button" class="btn btn-primary" value="Add">
        </form>
        <table class="table mt-5">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Product Category</th>
                <th scope="col">Product Name</th>
                <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>{{ category }}</td>
                    <td>{{ product }}</td>
                    <td>{{ total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            product:           '',
                   category:   '',
            total:      ''
        }
    },
    methods: {
        addNewTodo() {
        this.todos.push({
            id: this.nextTodoId++,
            title: this.newTodoText
        })
        this.newTodoText = ''
        }
    }
}
</script>