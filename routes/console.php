<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use App\Models\Booking;

Artisan::command('catalog:stats', function () {
    $this->info('=== Статистика каталога и системы ===');
    $this->line('Всего книг: ' . Book::count());
    $this->line('Всего жанров: ' . Genre::count());
    $this->line('Всего пользователей: ' . User::count());
    $this->line('Всего заявок (бронирований): ' . Booking::count());
})->purpose('Короткая статистика каталога');

// Настройка расписания (Задание 3)
Schedule::command('bookings:close-old --days=7')
    ->dailyAt('03:00')
    ->withoutOverlapping();

Schedule::command('catalog:stats')
    ->everyMinute()
    ->appendOutputTo(storage_path('logs/stats.log'));