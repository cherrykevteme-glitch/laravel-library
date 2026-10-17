@extends('layouts.app')

@section('title', 'Каталог книг')

@section('content')
    <h2>📚 Каталог библиотеки</h2>

    @forelse ($books as $book)
        <div class="book">
            <h3>{{ $book['title'] }}</h3>
            <p><strong>Автор:</strong> {{ $book['author'] }}</p>
            <a href="/books/{{ $book['id'] }}">Подробнее →</a>
        </div>
        <hr>
    @empty
        <p>Книг пока нет.</p>
    @endforelse
@endsection