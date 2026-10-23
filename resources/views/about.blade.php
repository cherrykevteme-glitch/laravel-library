@extends('layouts.app')

@section('title', 'О проекте')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h2 class="text-primary mb-3">О проекте</h2>
                <p><strong>Разработчик / Главный:</strong> {{ $author }}</p>
                <p><strong>Группа:</strong> {{ $group }}</p>
                <hr>
                <p class="text-secondary">
                    Этот проект представляет собой современное веб-приложение на базе Laravel и Bootstrap. 
                    Оно включает в себя полноценный каталог книг, систему бронирования для пользователей 
                    и REST API интерфейс для интеграции.
                </p>
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-secondary">На главную</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection