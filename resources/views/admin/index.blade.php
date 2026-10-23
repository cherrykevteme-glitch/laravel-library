@extends('layouts.app')

@section('title', 'Панель управления книгами')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Управление каталогом книг</h2>
    <div>
        <a href="{{ route('books.create') }}" class="btn btn-success me-2">+ Добавить книгу</a>
        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Выйти</button>
        </form>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Год</th>
                    <th class="text-end">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td class="fw-bold">{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить эту книгу из базы?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Книг пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $books->links() }}
</div>
@endsection