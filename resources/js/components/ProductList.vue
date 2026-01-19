<template>
    <!-- <h1>Product List</h1>   -->
    <div class="wrapper">
        <div class="col" v-for="product in products" :key="product.id">
            <div>
                <strong>{{ product.name }}</strong> - {{ product.price }}₽
            </div>
            {{ product.description }}
            <router-link :to="`/products/${product.id}/edit`" class="btn">Edit</router-link>
            <button @click="deleteProduct(product.id)" class="delete-btn btn">Delete</button>
        </div>
    </div>
    <router-link to="/products/create" class="create-btn btn">Add</router-link>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
        };
    },
    async created() {
        const response = await axios.get('/api/products');
        this.products = response.data;
    },
    methods: {
        async deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                await axios.delete(`/api/products/${id}`);
                this.products = this.products.filter(product => product.id !== id);
            }
        },
    },
};
</script>

<style scoped>
.btn{
    border: 1px solid;
    height: 50px;
    width: 100px;
    cursor: pointer;
    text-decoration: none;
    justify-content: center;
    align-items: center;
    display: flex;
}

.delete-btn {
    background-color: red;
    color: white;
}

.create-btn {
    margin: 0 auto;
    margin-top: 5px;
    background-color: green;
    color: white;
}

* {
    box-sizing: border-box;
}

.wrapper {
    padding-right: 20px;
    padding-left: 20px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    /* justify-content: center; */
}

.col {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid;
    border-radius: 10px;
    padding: 20px;
}

h1 {
    display: flex;
    justify-content: center;
    margin: 10px;
}

@media (max-width: 768px) {
    .wrapper {
        grid-template-columns: 1fr; /* 1 колонка на мобильных */
    }
}
</style>