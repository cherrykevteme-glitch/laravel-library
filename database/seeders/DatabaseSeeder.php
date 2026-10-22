<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем администратора, если его еще нет
        User::firstOrCreate(
            ['email' => 'admin@test.kz'], // по какому полю проверяем уникальность
            [
                'name' => 'Администратор',
                'password' => Hash::make('password'), // или ваш пароль
                'role' => 'admin',
            ]
        );

        // Вызов нашего сидера книг
        $this->call([
            BookSeeder::class,
        ]);
    }
}