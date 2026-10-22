<?php

namespace App\Jobs;

use App\Models\Book;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GenerateCatalogPdf implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 10;

    public function __construct(public User $user) {}

    public function handle(): void
    {
        $books = Book::orderBy('title')->get();
        // Упрощенная генерация содержимого PDF для примера
        $pdfContent = "Каталог книг:\n" . $books->pluck('title')->implode("\n");

        $file = 'catalog-' . now()->format('Ymd-His') . '.txt';
        Storage::disk('public')->put("exports/{$file}", $pdfContent);

        // Отправка уведомления пользователю
        // $this->user->notify(new \App\Notifications\ExportReady($file));
        Log::info("PDF-каталог сформирован: exports/{$file}");
    }

    public function failed(?Throwable $e): void
    {
        Log::error('PDF не создан: ' . $e?->getMessage());
    }
}