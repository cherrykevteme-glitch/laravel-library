<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книжный каталог</title>
    <!-- Подключаем Tailwind CSS через CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased font-sans min-h-screen flex flex-col">

    <!-- Навигация / Шапка -->
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="{{ route('books.index') }}" class="text-xl font-bold tracking-wide hover:opacity-90">
                📚 Книжная Лаборатория
            </a>
            <div class="space-x-4">
                <a href="{{ route('books.index') }}" class="px-3 py-2 rounded-md hover:bg-indigo-700 transition">Каталог</a>
                <a href="{{ route('genres.index') }}" class="px-3 py-2 rounded-md hover:bg-indigo-700 transition">Жанры</a>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow w-full">
        @yield('content')
    </main>

    <!-- Подвал -->
    <footer class="bg-white border-t border-gray-200 py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} Книжный каталог | Лабораторная работа №5
    </footer>

</body>
</html>