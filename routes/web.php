<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\BookController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Полный набор маршрутов приложения с учетом кэширования (ЛР №11)
|--------------------------------------------------------------------------
*/

// 1. Главная страница и каталог с кэшированием данных на 10 минут (Задание 4, ЛР №11)
Route::get('/', function () {
    $books = Cache::remember('home.books', now()->addMinutes(10), function () {
        return Book::paginate(10);
    });
    return view('catalog', compact('books'));
})->name('home');

Route::get('/catalog', function () {
    $books = Cache::remember('home.books', now()->addMinutes(10), function () {
        return Book::paginate(10);
    });
    return view('catalog', compact('books'));
})->name('catalog');

Route::get('/books', function () {
    $books = Book::paginate(10);
    return view('books.index', compact('books'));
})->name('books.index');

Route::get('/books/{id}', function ($id) {
    $book = Book::findOrFail($id);
    return view('books.show', compact('book'));
})->name('books.show');

// Публичные обработчики отправки форм из каталога/карточки
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');

// 2. Информационные страницы
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/rules', function () {
    return view('rules');
})->name('rules');

// 3. Авторизация и Регистрация
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/books');
    }

    return back()->withErrors([
        'email' => 'Введенные учетные данные неверны.',
    ])->onlyInput('email');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    return redirect()->route('login');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// 4. Панель администратора и управление книгами (защищено авторизацией)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    Route::get('/', function () {
        return view('admin.index'); 
    })->name('admin.index');

    // Управление книгами в админке
    Route::get('/books', [BookController::class, 'index'])->name('admin.books.index');
    
    // Маршруты для скачивания / генерации PDF в админке
    Route::get('/books/pdf', [BookController::class, 'pdf'])->name('admin.books.pdf');
    Route::get('/books/pdf-background', [BookController::class, 'generatePdfAsync'])->name('admin.books.pdf.bg');

    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('admin.books.destroy');
});