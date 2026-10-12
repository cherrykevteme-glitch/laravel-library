<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Книга №{{ $id }}</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .card {
            background: #222;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            margin: auto;
        }

        a {
            display: inline-block;
            background: #444;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Книга №{{ $id }}</h1>

    <p>Вы открыли страницу книги с номером {{ $id }}.</p>

    <p>Номер книги передаётся через маршрут Laravel.</p>

    <a href="{{ route('home') }}">На главную</a>
</div>

</body>
</html>