<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {

    // Публичный вход с жестким лимитом
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');

    // Маршруты, требующие токена Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::delete('/tokens', [AuthController::class, 'logoutAll'])->name('tokens.destroy');

        // Модификация книг
        Route::apiResource('books', BookController::class)->only(['store', 'update', 'destroy']);

        // Заявки
        Route::post('/books/{book}/bookings', [BookingController::class, 'store'])->name('books.bookings.store');
        Route::get('/me/bookings', [BookingController::class, 'myBookings'])->name('me.bookings');
    });
});