@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('books.index') }}" class="inline-block mb-6 text-sm text-indigo-600 hover:underline">
        ← Назад в каталог
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
        <span class="inline-block bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase mb-4">
            {{ $book->genre->name ?? 'Без жанра' }}
        </span>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $book->title }}</h1>
        <p class="text-lg text-gray-600 mb-6">Автор: <span class="font-semibold text-gray-800">{{ $book->author }}</span></p>

        <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl mb-6 text-sm">
            <div><span class="text-gray-500">Год издания:</span> <strong>{{ $book->year }}</strong></div>
            <div><span class="text-gray-500">Страниц:</span> <strong>{{ $book->pages ?? '—' }}</strong></div>
            <div><span class="text-gray-500">Цена:</span> <strong>{{ $book->price ? $book->price . ' ₸' : '—' }}</strong></div>
            <div>
                <span class="text-gray-500">Статус:</span> 
                <span class="font-bold {{ $book->is_available ? 'text-green-600' : 'text-red-500' }}">
                    {{ $book->is_available ? 'В наличии' : 'Нет в наличии' }}
                </span>
            </div>
        </div>

        <h3 class="text-lg font-bold text-gray-900 mb-2">Описание</h3>
        <p class="text-gray-700 leading-relaxed">{{ $book->description ?? 'Описание отсутствует.' }}</p>
    </div>

    <!-- Похожие книги -->
    @if(isset($relatedBooks) && $relatedBooks->count())
        <div class="mt-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Похожие книги в жанре "{{ $book->genre->name }}"</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($relatedBooks as $related)
                    <a href="{{ route('books.show', $related) }}" class="block bg-white p-4 rounded-xl border border-gray-200 hover:border-indigo-500 transition">
                        <h4 class="font-bold text-gray-800 text-sm mb-1 truncate">{{ $related->title }}</h4>
                        <p class="text-xs text-gray-500">{{ $related->author }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection