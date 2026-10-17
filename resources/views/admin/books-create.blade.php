@extends('layouts.app')

@section('title', 'Добавление книги')

@section('content')
    <h2>Добавление новой книги</h2>

    <form>
        <label>Название книги:</label>
        <br>
        <input type="text" name="title">
        <br><br>

        <label>Автор:</label>
        <br>
        <input type="text" name="author">
        <br><br>

        <button type="button">Добавить книгу</button>
    </form>

    <br>
    <a href="/admin/books">Назад к управлению книгами</a>
@endsection