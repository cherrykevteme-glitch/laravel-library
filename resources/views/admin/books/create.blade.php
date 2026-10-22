<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление книги</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">← Назад к списку</a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Добавить новую книгу</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Название книги *</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label fw-bold">Автор *</label>
                            <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label fw-bold">Год издания *</label>
                            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', 2026) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="genre_id" class="form-label fw-bold">Жанр *</label>
                            <select name="genre_id" id="genre_id" class="form-select" required>
                                <option value="">-- Выберите жанр --</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Описание</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label fw-bold">Обложка книги</label>
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="attachment" class="form-label fw-bold">Файл книги (PDF / DOCX)</label>
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success px-4">Сохранить книгу</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>