<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Разрешаем массовое заполнение этих полей
    protected $fillable = [
        'user_id',
        'book_id',
        'phone',
    ];

    // Связь с пользователем (если нужна)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с книгой (если нужна)
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}