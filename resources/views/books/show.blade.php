@extends('layouts.app')

@section('title', 'Книга: ' . $book->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h2 class="text-primary">{{ $book->title }}</h2>
                <h5 class="text-muted mb-3">Автор: {{ $book->author }}</h5>
                <p><strong>Год издания:</strong> {{ $book->year }}</p>
                <hr>
                <p><strong>Описание:</strong></p>
                <p class="text-secondary">{{ $book->description ?? 'Описание отсутствует.' }}</p>

                <div class="mt-4">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Назад к каталогу</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection