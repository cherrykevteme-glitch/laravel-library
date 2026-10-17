<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
        }

        header {
            background: #1e293b;
            color: white;
            padding: 20px 40px;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px #0001;
        }

        h1 {
            margin-top: 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px 10px 0 0;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .green {
            background: #16a34a;
        }

        .green:hover {
            background: #15803d;
        }
    </style>
</head>

<body>

<header>
    <h2>📚 Админ-панель библиотеки</h2>
</header>

<div class="container">

    <div class="card">

        <h1>Панель администратора</h1>

        <p>Добро пожаловать в систему управления библиотекой!</p>

        <h3>Управление книгами</h3>

        <a href="{{ url('/books') }}" class="btn">
            📖 Каталог книг
        </a>

        <a href="{{ url('/admin/books/create') }}" class="btn green">
            ➕ Добавить книгу
        </a>

        <hr>

        <h3>Информация</h3>

        <p>Система управления каталогом библиотеки.</p>

        <p>Лабораторная работа №3 — Laravel.</p>

    </div>

</div>

</body>
</html>