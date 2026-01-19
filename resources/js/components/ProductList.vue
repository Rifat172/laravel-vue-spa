<template>
    <!-- Поиск -->
    <div class="max-w-md mx-auto mb-8 px-4">
        <input v-model="searchQuery" placeholder="Поиск по названию или описанию..."
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Состояния -->
    <div v-if="loading" class="text-center text-2xl py-20 text-gray-600">Загрузка...</div>
    <div v-else-if="error" class="text-center text-red-600 text-xl py-10">{{ error }}</div>
    <div v-else-if="!filteredProducts.length" class="text-center text-gray-500 text-xl py-20">
        Нет продуктов
    </div>

    <!-- Замените ваш grid на этот -->
    <div v-else class="grid grid-cols-1 gap-8 px-4 md:px-8"
        style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
        <div v-for="product in filteredProducts" :key="product.id"
            class="bg-white rounded-xl shadow-lg p-6 flex flex-col border border-gray-200">
            <!-- Контент -->
            <div class="flex-grow">
                <h3 class="text-xl font-bold mb-2">{{ product.name }}</h3>
                <p class="text-lg font-semibold text-gray-700 mb-4">{{ product.price }}₽</p>
                <p class="text-sm text-gray-600 line-clamp-3">{{ product.description }}</p>
            </div>

            <!-- Кнопки -->
            <div class="flex justify-end gap-4 mt-auto pt-6">
                <router-link :to="{ name: 'products.edit', params: { id: product.id } }"
                    class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors whitespace-nowrap">
                    Edit
                </router-link>
                <button @click="deleteProduct(product.id)"
                    class="px-5 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors whitespace-nowrap">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Пагинация (раскомментируйте, если используете Laravel paginate()) -->
    <!-- <Pagination :links="paginator.links" /> -->

    <!-- Кнопка добавления -->
    <div class="text-center mt-12">
        <router-link :to="{ name: 'products.create' }"
            class="inline-block px-8 py-4 bg-green-600 text-white text-lg font-medium rounded-lg hover:bg-green-700 transition-colors">
            Add Product
        </router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
            searchQuery: '',      // Добавили!
            loading: true,
            error: null,
        };
    },

    computed: {
        filteredProducts() {
            if (!this.searchQuery.trim()) return this.products;

            const query = this.searchQuery.toLowerCase();
            return this.products.filter(product =>
                product.name.toLowerCase().includes(query) ||
                (product.description && product.description.toLowerCase().includes(query))
            );
        },
    },

    async created() {
        try {
            const response = await axios.get('/api/products');
            this.products = response.data.data || response.data; // Поддержка пагинации или простого массива
        } catch (err) {
            this.error = 'Не удалось загрузить продукты';
            console.error(err);
        } finally {
            this.loading = false;
        }
    },

    methods: {
        async deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                try {
                    await axios.delete(`/api/products/${id}`);
                    this.products = this.products.filter(p => p.id !== id);
                } catch (err) {
                    alert('Ошибка при удалении');
                }
            }
        },
    },
};
</script>

<style scoped>
/* Обрезка текста до 3 строк */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>