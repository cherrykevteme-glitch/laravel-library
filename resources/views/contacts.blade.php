<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
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
    <h1>Контакты библиотеки</h1>

    <p>Email: {{ $email }}</p>
    <p>Телефон: {{ $phone }}</p>

    <a href="{{ route('home') }}">На главную</a>
</div>

</body>
</html>