@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1>Добро пожаловать!</h1>
    <p>Лабораторная работа №7: Аутентификация и политики</p>
    
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Войти</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Зарегистрироваться</a>
    @endguest

    @auth
        @can('admin-panel')
            <a href="{{ route('admin.books.index') }}" class="btn btn-success">Перейти в админ-панель</a>
        @endcan
    @endauth
</div>
@endsection