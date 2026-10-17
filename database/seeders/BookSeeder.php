<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            ['genre_id' => 1, 'title' => 'Абай жолы', 'author' => 'М. Ауэзов', 'year' => 1942, 'pages' => 600, 'price' => 4500.00, 'description' => 'Эпопея', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 1, 'title' => 'Мастер и Маргарита', 'author' => 'М. Булгаков', 'year' => 1967, 'pages' => 480, 'price' => 3800.00, 'description' => 'Роман', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 2, 'title' => '451 градус по Фаренгейту', 'author' => 'Р. Брэдбери', 'year' => 1953, 'pages' => 256, 'price' => 2900.00, 'description' => 'Антиутопия', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 3, 'title' => 'Приключения Шерлока Холмса', 'author' => 'А. Конан Дойл', 'year' => 1892, 'pages' => 320, 'price' => 3300.00, 'description' => 'Детектив', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 4, 'title' => 'Капитанская дочка', 'author' => 'А. Пушкин', 'year' => 1836, 'pages' => 190, 'price' => 2100.00, 'description' => 'История', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 1, 'title' => 'Преступление и наказание', 'author' => 'Ф. Достоевский', 'year' => 1866, 'pages' => 670, 'price' => 3900.00, 'description' => 'Классика', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 2, 'title' => 'Солярис', 'author' => 'С. Лем', 'year' => 1961, 'pages' => 280, 'price' => 3100.00, 'description' => 'Фантастика', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 3, 'title' => 'Десять негритят', 'author' => 'А. Кристи', 'year' => 1939, 'pages' => 220, 'price' => 2800.00, 'description' => 'Детектив', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 1, 'title' => 'Война и мир', 'author' => 'Л. Толстой', 'year' => 1869, 'pages' => 1225, 'price' => 7000.00, 'description' => 'Эпопея', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['genre_id' => 2, 'title' => 'Дюна', 'author' => 'Ф. Герберт', 'year' => 1965, 'pages' => 700, 'price' => 5200.00, 'description' => 'Фантастика', 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}