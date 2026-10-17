@extends('layouts.app')

@section('title', $book['title'])

@section('content')
    <h2>{{ $book['title'] }}</h2>

    <p><strong>Автор:</strong> {{ $book['author'] }}</p>

    <p><strong>Номер книги:</strong> {{ $book['id'] }}</p>

    <a href="/books">← Вернуться к каталогу</a>
@endsection