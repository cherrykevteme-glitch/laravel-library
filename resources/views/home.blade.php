@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold text-primary">Добро пожаловать в {{ config('app.name', 'Библиотеку') }}</h1>
        <p class="col-md-8 fs-4 text-secondary">Здесь вы можете просматривать доступные книги, добавлять новые экземпляры и оформлять заявки на бронирование.</p>
        <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg mt-2">Перейти в каталог книг</a>
    </div>
</div>
@endsection