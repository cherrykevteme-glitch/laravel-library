@extends('layouts.app')

@section('title', 'Управление книгами')

@section('content')
    <h2>Управление книгами</h2>

    <p>Здесь можно управлять каталогом библиотеки.</p>

    <a href="/admin/books/create">Добавить книгу</a>
    <br><br>
    <a href="/books">Вернуться к каталогу</a>
@endsection