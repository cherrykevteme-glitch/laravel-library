<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Вызываем сидер жанров из ЛР №4 (сохраняем настоящие жанры)
        $this->call(GenreSeeder::class);

        // Создаем 40 книг, используя существующие жанры (recycle)
        Book::factory(40)->recycle(Genre::all())->create();
    }
}