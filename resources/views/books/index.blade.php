<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список книг</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Каталог книг</h1>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">На главную</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($books as $book)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted mb-4">Автор: {{ $book->author ?? 'Не указан' }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary w-100">Подробнее / Забронировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">В базе данных пока нет ни одной книги.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>