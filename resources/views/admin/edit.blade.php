@extends('layouts.app')

@section('title', 'Редактирование книги')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Редактировать книгу #{{ $book->id }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Название книги</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Автор</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Год издания</label>
                        <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Описание</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $book->description) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection