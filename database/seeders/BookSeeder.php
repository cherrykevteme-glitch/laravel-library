<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Убедимся, что есть базовые жанры
        $genre1 = Genre::firstOrCreate(['name' => 'Фантастика']);
        $genre2 = Genre::firstOrCreate(['name' => 'Роман']);
        $genre3 = Genre::firstOrCreate(['name' => 'Детектив']);
        $genre4 = Genre::firstOrCreate(['name' => 'Приключения']);

        $books = [
            ['title' => 'Война и мир', 'author' => 'Лев Толстой', 'year' => 1869, 'genre_id' => $genre2->id, 'description' => 'Эпический роман о русской жизни в эпоху наполеоновских войн.'],
            ['title' => 'Преступление и наказание', 'author' => 'Фёдор Достоевский', 'year' => 1866, 'genre_id' => $genre2->id, 'description' => 'Психологический отчет об одном преступлении.'],
            ['title' => 'Мастер и Маргарита', 'author' => 'Михаил Булгаков', 'year' => 1967, 'genre_id' => $genre1->id, 'description' => 'Культовый роман о визите Воланда в Москву.'],
            ['title' => '1984', 'author' => 'Джордж Оруэлл', 'year' => 1949, 'genre_id' => $genre1->id, 'description' => 'Знаменитая антиутопия о тоталитарном обществе.'],
            ['title' => 'Гарри Поттер и философский камень', 'author' => 'Джоан Роулинг', 'year' => 1997, 'genre_id' => $genre4->id, 'description' => 'Начало истории о мальчике, который выжил.'],
            ['title' => 'Властелин Колец: Братство Кольца', 'author' => 'Джон Р. Р. Толкин', 'year' => 1954, 'genre_id' => $genre4->id, 'description' => 'Величайшее фэнтези-произведение в истории.'],
            ['title' => 'Шерлок Холмс: Этюд в багровых тонах', 'author' => 'Артур Конан Дойл', 'year' => 1887, 'genre_id' => $genre3->id, 'description' => 'Первое появление легендарного сыщика.'],
            ['title' => 'Убийство в «Восточном экспрессе»', 'author' => 'Агата Кристи', 'year' => 1934, 'genre_id' => $genre3->id, 'description' => 'Классический детектив с Эркюлем Пуаро.'],
            ['title' => 'Марсианин', 'author' => 'Энди Уир', 'year' => 2011, 'genre_id' => $genre1->id, 'description' => 'История выживания астронавта на Красной планете.'],
            ['title' => 'Три мушкетера', 'author' => 'Александр Дюма', 'year' => 1844, 'genre_id' => $genre4->id, 'description' => 'Приключения д\'Артаньяна и его преданных друзей.'],
            ['title' => 'Евгений Онегин', 'author' => 'Александр Пушкин', 'year' => 1833, 'genre_id' => $genre2->id, 'description' => 'Энциклопедия русской жизни в стихах.'],
            ['title' => 'Собака Баскервилей', 'author' => 'Артур Конан Дойл', 'year' => 1902, 'genre_id' => $genre3->id, 'description' => 'Мрачная тайна родового проклятия на торфяных болотах.'],
            ['title' => 'Метро 2033', 'author' => 'Дмитрий Глуховский', 'year' => 2005, 'genre_id' => $genre1->id, 'description' => 'Жизнь людей в московском метро после ядерного апокалипсиса.'],
            ['title' => 'Портрет Дориана Грея', 'author' => 'Оскар Уайльд', 'year' => 1890, 'genre_id' => $genre2->id, 'description' => 'Философский роман о погоне за вечной молодостью.'],
            ['title' => 'Дюна', 'author' => 'Фрэнк Герберт', 'year' => 1965, 'genre_id' => $genre1->id, 'description' => 'Борьба за контроль над пустынной планетой Арракис.']
        ];

        foreach ($books as $bookData) {
            Book::firstOrCreate(
                ['title' => $bookData['title']],
                [
                    'author' => $bookData['author'],
                    'year' => $bookData['year'],
                    'genre_id' => $bookData['genre_id'],
                    'description' => $bookData['description'],
                    'user_id' => 1
                ]
            );
        }
    }
}