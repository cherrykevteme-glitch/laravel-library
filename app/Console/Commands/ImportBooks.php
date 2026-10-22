<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Console\Command;

class ImportBooks extends Command
{
    protected $signature = 'books:import {file : Путь к CSV файлу в папке storage/app}';
    protected $description = 'Импорт книг из CSV файла';

    public function handle(): int
    {
        $path = storage_path('app/' . $this->argument('file'));

        if (!file_exists($path)) {
            $this->error("Файл не найден: {$path}");
            return self::FAILURE;
        }

        // Берем первый попавшийся жанр из базы, чтобы удовлетворить NOT NULL constraint для genre_id
        $defaultGenre = Genre::first();
        if (!$defaultGenre) {
            $this->error("В базе данных нет ни одного жанра! Сначала добавьте жанр через админку.");
            return self::FAILURE;
        }

        $handle = fopen($path, 'r');
        $added = 0;
        $skipped = 0;
        $rowNumber = 0;

        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            $rowNumber++;
            if (count($data) < 2) {
                $this->warn("Строка {$rowNumber}: пропущена из-за неверного формата.");
                $skipped++;
                continue;
            }

            // Создаем книгу со всеми обязательными полями
            Book::create([
                'title' => trim($data[0]),
                'author' => trim($data[1] ?? 'Неизвестен'),
                'genre_id' => $defaultGenre->id,
                'year' => 2020, // Указываем год по умолчанию, чтобы не было ошибки NOT NULL для books.year
            ]);
            $added++;
        }

        fclose($handle);

        $this->info("Импорт завершен. Добавлено: {$added}, пропущено: {$skipped}.");
        return self::SUCCESS;
    }
}