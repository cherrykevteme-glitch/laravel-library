<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            // Внешний ключ на таблицу genres (связь с жанром)
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('author', 120);
            $table->unsignedSmallInteger('year');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
