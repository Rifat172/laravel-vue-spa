<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vue Laravel App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="grid min-h-screen grid-rows-[auto_1fr_auto] grid-cols-1 lg:grid-cols-[200px_1fr_200px]">
        <header class="col-span-full bg-cyan-400 h-12 flex items-center justify-center">
            header
        </header>

        <aside class="left-bar bg-blue-600 hidden lg:block">
            left-bar
        </aside>

        <main class="overflow-y-auto bg-amber-800">
            <div id="app"></div>
        </main>

        <aside class="right-bar bg-purple-600 hidden lg:block">
            right-bar
        </aside>

        <footer class="col-span-full bg-cyan-400 h-12 flex items-center justify-center">
            footer
        </footer>
    </div>
</body>

</html>