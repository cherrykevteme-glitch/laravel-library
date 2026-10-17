@extends('layouts.app')

@section('title', $book['title'] ?? 'Информация о книге')

@section('content')

<div class="card" style="padding: 25px; margin: 20px 0;">

    <h1>📖 {{ $book['title'] }}</h1>

    <p>
        <strong>Автор:</strong>
        {{ $book['author'] }}
    </p>

    <p>
        <strong>Год издания:</strong>
        {{ $book['year'] ?? 'Не указан' }}
    </p>

    @if(($book['year'] ?? 9999) < 1950)
        <span class="badge">⭐ Классика</span>
    @endif

    <br><br>

    <a href="{{ route('books.index') }}">
        ← Вернуться в каталог
    </a>

</div>

@endsection