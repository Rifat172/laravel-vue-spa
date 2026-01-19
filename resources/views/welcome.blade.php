<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vue Laravel App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="wrapper">
        <header>
            header
        </header>
        <div class="left-bar">
            left-bar
        </div>
        <main>
            <script type="module" str="{{ Vite::asset('resources/js/app.js') }}"></script>
            <div id="app"></div>
        </main>
        <div class="right-bar">
            right-bar
        </div>
        <footer>
            footer
        </footer>
    </div>
</body>

</html>