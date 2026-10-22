<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookObserver
{
    public function created(Book $book): void
    {
        Log::info("Создана запись книги #{$book->id}: {$book->title}");
        Cache::forget('home.books'); // Сбрасываем кэш главной страницы
    }

    public function updated(Book $book): void
    {
        Log::info("Обновлена книга #{$book->id}.");
        Cache::forget('home.books'); // Сбрасываем кэш главной страницы
    }

    public function deleting(Book $book): void
    {
        if (!empty($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }
    }

    public function deleted(Book $book): void
    {
        Cache::forget('home.books'); // Сбрасываем кэш главной страницы
    }
}