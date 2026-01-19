<template>
    <input v-model="searchQuery" placeholder="Поиск..." class="border rounded p-2 mb-4" />
    <div v-if="loading" class="text-center">Загрузка...</div>
    <div v-else-if="error" class="text-red-600 text-center">{{ error }}</div>
    <div v-if="!products.length && !loading" class="text-center text-gray-500">
        Нет продуктов
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
        <div v-for="product in products" :key="product.id"
            class="flex flex-col justify-between bg-white rounded-lg shadow-lg p-6 h-64 border">
            <div>
                <h3 class="text-lg font-bold">{{ product.name }}</h3>
                <p class="text-gray-700">{{ product.price }}₽</p>
                <p class="text-sm text-gray-600 mt-2">{{ product.description }}</p>
            </div>
            <div class="flex justify-end gap-3 mt-4">
                <router-link :to="{ name: 'products.edit', params: { id: product.id } }" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Edit
                </router-link>
                <button @click="deleteProduct(product.id)"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>
    <Pagination :links="products.links" /> <!-- если возвращаете с бэкенда paginate() -->
    <router-link :to="{ name: 'products.create' }" class="block mx-auto mt-8 px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700 text-center w-fit">
        Add Product
    </router-link>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
            loading: true,
            error: null,
        };
    },
    async created() {
        try {
            const response = await axios.get('/api/products');
            this.products = response.data;
        } catch (err) {
            this.error = 'Не удалось загрузить продукты';
        } finally {
            this.loading = false;
        }
    },
    methods: {
        async deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                await axios.delete(`/api/products/${id}`);
                this.products = this.products.filter(product => product.id !== id);
            }
        },
    },
    computed: {
        filteredProducts() {
            return this.products.filter(p =>
                p.name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        }
    }
};
</script>