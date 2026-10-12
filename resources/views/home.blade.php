<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Библиотека</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        a {
            display: inline-block;
            background: #444;
            color: white;
            padding: 12px 20px;
            margin: 10px;
            border-radius: 10px;
            text-decoration: none;
        }

        a:hover {
            background: #666;
        }
    </style>
</head>
<body>

    <h1>📚 Добро пожаловать в библиотеку!</h1>

    <p>Сегодня: {{ now()->format('d.m.Y') }}</p>

    <a href="{{ route('about') }}">О проекте</a>
    <a href="{{ route('contacts') }}">Контакты</a>
    <a href="{{ route('books.show', 1) }}">Книга №1</a>

</body>
</html>