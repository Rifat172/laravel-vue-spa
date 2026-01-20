<template>
    <div class="grid min-h-screen grid-rows-[auto_1fr_auto] grid-cols-1 lg:grid-cols-[auto_1fr_auto]">
        <!-- Header -->
        <header class="col-span-full bg-cyan-400 h-12 flex items-center justify-start px-4 gap-4">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-2xl focus:outline-none">
                ☰
            </button>
            <div class="text-center flex-1">Header</div>
        </header>

        <!-- Sidebar (ваше меню) -->
        <Sidebar v-model:sidebar-open="sidebarOpen" />

        <!-- Main (контент страниц, например ProductList) -->
        <main class="overflow-y-auto bg-amber-800 p-4 md:p-8">
            <router-view />
        </main>

        <!-- Right sidebar -->
        <aside class="bg-purple-600 hidden lg:block p-6 text-white">
            right-bar content
        </aside>

        <!-- Footer -->
        <footer class="col-span-full bg-cyan-400 h-12 flex items-center justify-center">
            footer
        </footer>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Sidebar from '../components/layout/Sidebar.vue';  // Проверьте путь! Если ошибка — попробуйте './components/layout/Sidebar.vue' или полный относительный

// Состояние меню
const sidebarOpen = ref(window.innerWidth >= 1024);

// Обработчик ресайза
const handleResize = () => {
    sidebarOpen.value = window.innerWidth >= 1024;
};

onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});
</script>