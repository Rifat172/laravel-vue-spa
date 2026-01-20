<template>
    <!-- Overlay (тёмная область) -->
    <div v-if="sidebarOpen" class="fixed inset-0 bg-black/50 z-40 lg:hidden" @click="closeSidebar"></div>

    <!-- Меню -->
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:block lg:w-auto"
        :class="{ '-translate-x-full': !sidebarOpen }">
        <div class="p-6 text-gray-100">
            <h3 class="text-xl font-bold mb-6 text-white">Меню</h3>
            <ul>
                <li class="mb-3">
                    <router-link to="/" @click="closeOnMobile"
                        class="block hover:bg-gray-700 p-3 rounded-lg transition text-gray-200 hover:text-white">
                        Главная
                    </router-link>
                </li>
                <li class="mb-3">
                    <router-link to="/products/create" @click="closeOnMobile"
                        class="block hover:bg-gray-700 p-3 rounded-lg transition text-gray-200 hover:text-white">
                        Добавить продукт
                    </router-link>
                </li>
                <!-- Другие ссылки -->
            </ul>
        </div>
    </aside>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    sidebarOpen: Boolean,
});

const emit = defineEmits(['update:sidebarOpen']);

const sidebarOpen = computed({
    get() {
        return props.sidebarOpen;
    },
    set(value) {
        emit('update:sidebarOpen', value);
    },
});

// Закрытие меню (для overlay и кнопки)
const closeSidebar = () => {
    sidebarOpen.value = false;
};

// Закрытие только на мобильных (для ссылок в меню)
const closeOnMobile = () => {
    if (window.innerWidth < 1024) {
        sidebarOpen.value = false;
    }
};
</script>