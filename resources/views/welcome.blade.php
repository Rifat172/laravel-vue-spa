<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vue Laravel App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="grid min-h-screen grid-rows-[auto_1fr_auto] grid-cols-1 lg:grid-cols-[auto_1fr_auto]">
        <!-- Header -->
        <header class="col-span-full bg-cyan-400 h-12 flex items-center justify-start px-4 gap-4">
            <button id="mobile-menu-button" class="lg:hidden text-2xl focus:outline-none">
                ☰
            </button>
            <div class="text-center flex-1">header</div>
        </header>

        <!-- Overlay (тёмный фон для закрытия по клику вне меню) -->
        <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

        <aside id="left-sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:block lg:w-auto">
            <div class="p-6 text-gray-100"> <!-- текст чуть светлее для контраста -->
                <h3 class="text-xl font-bold mb-6 text-white">Меню</h3>
                <ul>
                    <li class="mb-3">
                        <a href="/"
                            class="block hover:bg-gray-700 p-3 rounded-lg transition text-gray-200 hover:text-white">
                            Главная
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="/products/create"
                            class="block hover:bg-gray-700 p-3 rounded-lg transition text-gray-200 hover:text-white">
                            Добавить продукт
                        </a>
                    </li>
                    <!-- Добавьте другие ссылки аналогично -->
                </ul>
            </div>
        </aside>

        <!-- Main -->
        <main class="overflow-y-auto p-4 md:p-8">
            <div id="app"></div>
        </main>

        <!-- Right sidebar -->
        <aside class=" hidden lg:block p-6 text-white">
            right-bar content
        </aside>

        <!-- Footer -->
        <footer class="col-span-full bg-cyan-400 h-12 flex items-center justify-center">
            footer
        </footer>
    </div>

    <script>
        const menuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('left-sidebar');
        const overlay = document.getElementById('mobile-overlay');

        // Функция для правильного состояния в зависимости от ширины экрана
        function updateSidebarState() {
            if (window.innerWidth >= 1024) {
                // Десктоп: меню всегда открыто, overlay скрыт
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                // Мобильный: меню скрыто по умолчанию, overlay скрыт
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Инициализация при загрузке страницы
        updateSidebarState();

        // Обработчик кнопки
        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        // Закрытие по клику на overlay
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Обновление при изменении размера окна
        window.addEventListener('resize', updateSidebarState);
    </script>
</body>

</html>