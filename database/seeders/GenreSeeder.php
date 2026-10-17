<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genres')->insert([
            ['name' => 'Художественная литература', 'description' => 'Романы и классика', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Научная фантастика', 'description' => 'Книги о будущем', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Детективы', 'description' => 'Расследования', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Историческая литература', 'description' => 'Исторические хроники', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}