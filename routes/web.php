<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Главная страница
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/books');
});

/*
|--------------------------------------------------------------------------
| Каталог книг
|--------------------------------------------------------------------------
*/

// Список всех книг
Route::get('/books', [BookController::class, 'index'])
    ->name('books.index');

// Просмотр книги
Route::get('/books/{book}', [BookController::class, 'show'])
    ->whereNumber('book')
    ->name('books.show');

/*
|--------------------------------------------------------------------------
| Админ-панель
|--------------------------------------------------------------------------
*/

// Главная страница админ-панели
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Форма добавления книги
Route::get('/admin/books/create', [BookController::class, 'create'])
    ->name('books.create');

// Сохранение новой книги
Route::post('/admin/books', [BookController::class, 'store'])
    ->name('books.store');

// Форма редактирования книги
Route::get('/admin/books/{book}/edit', [BookController::class, 'edit'])
    ->whereNumber('book')
    ->name('books.edit');

// Сохранение изменений
Route::put('/admin/books/{book}', [BookController::class, 'update'])
    ->whereNumber('book')
    ->name('books.update');

// Удаление книги
Route::delete('/admin/books/{book}', [BookController::class, 'destroy'])
    ->whereNumber('book')
    ->name('books.destroy');