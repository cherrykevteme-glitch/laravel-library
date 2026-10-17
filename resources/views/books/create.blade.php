<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить книгу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0002;
        }
        h1 { color: #1e293b; }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        a {
            display: inline-block;
            margin-left: 15px;
            color: #2563eb;
        }
        .error { color: #dc2626; }
    </style>
</head>
<body>

<div class="container">
    <h1>📚 Добавить книгу</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label>Название книги</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label>Автор</label>
        <input type="text" name="author" value="{{ old('author') }}" required>

        <label>Описание</label>
        <textarea name="description" rows="5">{{ old('description') }}</textarea>

        <button type="submit">➕ Добавить книгу</button>

        <a href="{{ route('admin.dashboard') }}">Назад</a>
    </form>
</div>

</body>
</html>