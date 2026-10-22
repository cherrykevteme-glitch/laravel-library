<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $book->title ?? 'Просмотр книги' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 600px;">
        <div class="card shadow p-4">
            <h2 class="mb-3">{{ $book->title ?? 'Информация о книге' }}</h2>
            <p class="text-muted">Автор: {{ $book->author ?? 'Не указан' }}</p>
            <p>{{ $book->description ?? 'Описание отсутствует.' }}</p>

            <hr class="my-4">

            @if(session('success'))
                <div class="mb-4 bg-success text-white p-3 rounded font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-danger text-white p-3 rounded">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Форма отправки бронирования -->
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <!-- Передаем ID книги скрытым полем, чтобы избежать ошибки базы данных -->
                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div class="mb-3">
                    <label for="phone" class="form-label text-secondary fw-bold">Телефон для связи</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="+7 (___) ___-__-__" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Забронировать книгу</button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('books.index') }}" class="text-decoration-none">← Вернуться к списку книг</a>
            </div>
        </div>
    </div>
</body>
</html>