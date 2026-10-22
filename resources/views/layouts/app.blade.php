<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №7</title>
    <!-- Подключаем Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Шапка сайта (Меню) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Библиотека</a>
            
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link" href="{{ route('home') }}">Главная</a>

                @guest
                    <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                @endguest

                @auth
                    @can('admin-panel')
                        <a class="nav-link text-warning fw-bold" href="{{ route('admin.books.index') }}">Админ-панель</a>
                    @endcan

                    <span class="nav-link text-light ms-2">{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Выйти</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>