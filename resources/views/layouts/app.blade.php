<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Библиотека')</title>

    {{-- Сборка стилей и скриптов через Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Шапка сайта --}}
    <header class="site-header">
        <div class="container">
            <a href="/" class="logo">📚 Библиотека</a>
            <nav class="main-nav">
                <a href="{{ url('/') }}">Главная</a>
                <a href="{{ url('/books') }}">Каталог книг</a>
            </nav>
        </div>
    </header>

    {{-- Основной контент --}}
    <main class="main-content">
        <div class="container">
            
            {{-- Системные уведомления через компонент Alert --}}
            @if (session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @endif

            @if (session('error'))
                <x-alert type="error">
                    {{ session('error') }}
                </x-alert>
            @endif

            {{-- Вывод основного содержимого страницы --}}
            @yield('content')

        </div>
    </main>

    {{-- Подвал сайта --}}
    <footer class="site-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Библиотека. Лабораторная работа №4.</p>
        </div>
    </footer>

    {{-- Кнопка «Наверх» (управляется из resources/js/app.js) --}}
    <button id="scrollTopBtn" class="scroll-top-btn" title="Наверх">↑</button>

</body>
</html>