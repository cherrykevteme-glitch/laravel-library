<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body text-body">

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">{{ config('app.name', 'Библиотека') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Каталог книг</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">О проекте</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Контакты</a></li>
                    <li class="nav-item"><a class="nav-link text-info fw-bold" href="{{ route('admin.books.index') }}">Админка</a></li>
                    <li class="nav-item"><a class="nav-link text-warning fw-bold" href="/api/v1/books" target="_blank">API (ЛР12)</a></li>
                    
                    <!-- Кнопка переключения темы -->
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <button id="themeToggle" class="btn btn-sm btn-outline-light" onclick="toggleTheme()">
                            🌙 Тёмная
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Скрипт переключения и сохранения темы -->
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const btn = document.getElementById('themeToggle');
            if (html.getAttribute('data-bs-theme') === 'dark') {
                html.setAttribute('data-bs-theme', 'light');
                btn.textContent = '🌙 Тёмная';
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-bs-theme', 'dark');
                btn.textContent = '☀️ Светлая';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Автоматическая загрузка сохраненной темы при открытии страниц
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            const btn = document.getElementById('themeToggle');
            if (btn) {
                btn.textContent = savedTheme === 'dark' ? '☀️ Светлая' : '🌙 Тёмная';
            }
        });
    </script>
</body>
</html>