<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Внешний ключ на пользователя (при удалении пользователя удаляются его заявки)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Внешний ключ на книгу (при удалении книги удаляются заявки на неё)
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            // Номер телефона пользователя
            $table->string('phone');
            // Необязательный комментарий к заявке
            $table->text('comment')->nullable();
            // Статус заявки (по умолчанию 'new')
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};