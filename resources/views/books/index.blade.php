@extends('layouts.app')

@section('title', 'Каталог книг')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Каталог книг</h2>
    <a href="{{ route('books.create') }}" class="btn btn-success">+ Добавить новую книгу</a>
</div>

<div class="row">
    @forelse($books as $book)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark fw-bold">{{ $book->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }} ({{ $book->year }})</h6>
                    <p class="card-text flex-grow-1 text-secondary">{{ Str::limit($book->description, 90) }}</p>
                    
                    <hr>
                    
                    <!-- Форма бронирования -->
                    <form action="{{ route('bookings.store') }}" method="POST" class="mb-2">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <div class="input-group input-group-sm">
                            <input type="text" name="phone" class="form-control" placeholder="Ваш телефон" required>
                            <button type="submit" class="btn btn-outline-primary">Забронировать</button>
                        </div>
                    </form>

                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-light w-100 border">Подробнее</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><p class="text-center text-muted">Книг пока нет.</p></div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $books->links() }}
</div>
@endsection