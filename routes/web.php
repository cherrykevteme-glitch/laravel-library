<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes (Проект "Библиотека" — Лабораторные работы №1–14)
|--------------------------------------------------------------------------
*/

// 1. ЛР №14: Маршрут для переключения языка интерфейса (RU | ҚАЗ | EN)
Route::get('/locale/{locale}', function (string $locale) {
    session(['locale' => $locale]);
    return back();
})->whereIn('locale', SetLocale::LOCALES)->name('locale');

// 2. ЛР №1–5: Базовые публичные страницы
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

// 3. ЛР №6–8: Аутентификация (Вход, Регистрация, Выход)
// (Если у вас используется Laravel Breeze / Jetstream, эти маршруты могут подключаться через auth.php, 
// но если вы писали контроллеры сами, используйте этот блок:)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// 4. ЛР №9–12: Публичный и административный каталог книг и жанров (Вариант 1)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');

// 5. ЛР №10–13: Защищенные маршруты (доступны только авторизованным пользователям)
Route::middleware(['auth'])->group(function () {
    // Личный кабинет / Дашборд
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Управление книгами и заявками (Админка / Действия пользователя)
    Route::post('/books/{book}/book', [BookController::class, 'storeBooking'])->name('books.booking');
    
    // Административные CRUD маршруты (если требуются по варианту)
    Route::resource('admin/books', BookController::class, ['names' => 'admin.books']);
    Route::resource('admin/genres', GenreController::class, ['names' => 'admin.genres']);
});

// 6. ЛР №14 (Задание 5.4): Временный маршрут для проверки обработки ошибок
// Внимание: после демонстрации преподавателю этот маршрут нужно удалить!
Route::get('/test-error', function () {
    throw new \RuntimeException('Проверка обработки исключений и записи в журнал из ЛР №14');
});