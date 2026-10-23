@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h2 class="text-primary mb-3">Контакты</h2>
                <p class="fs-5"><strong>Главный:</strong> {{ $manager }}</p>
                <p><strong>Телефон:</strong> {{ $phone }}</p>
                <p><strong>Email (Gmail):</strong> <a href="mailto:artyom222akopyan@gmail.com">{{ $email }}</a></p>
                <hr>
                <p class="text-secondary">Свяжитесь с нами по любым вопросам, связанным с работой библиотеки и бронированием книг.</p>
                
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-secondary">На главную</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection