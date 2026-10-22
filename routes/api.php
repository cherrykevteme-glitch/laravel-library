<?php

use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\GenreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (Лабораторная работа №12)
|--------------------------------------------------------------------------
| Все маршруты в этой группе автоматически получают префикс /api.
| Защищены ограничением частоты запросов (throttle:60,1 — 60 запросов в минуту).
*/

Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {
    
    // 1. Тестовый маршрут для проверки работоспособности API
    Route::get('/ping', fn () => [
        'status' => 'ok', 
        'time' => now()->toIso8601String()
    ]);

    // 2. Дополнительные специфичные маршруты 
    // ВАЖНО: Обязательно объявляйте их ДО apiResource, чтобы слово 'random' не перехватывалось как {book} (id)
    Route::get('/books/random', [BookController::class, 'random']);
    Route::get('/stats', [BookController::class, 'stats']);

    // 3. Основные REST-маршруты для чтения каталога книг (index и show)
    // apiResource автоматически исключает методы create и edit, так как API не рисует HTML-формы
    Route::apiResource('books', BookController::class)->only(['index', 'show']);

    // 4. Маршруты для работы со связанной сущностью (жанры / категории)
    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/genres/{genre}/books', [GenreController::class, 'books'])->name('genres.books');
});