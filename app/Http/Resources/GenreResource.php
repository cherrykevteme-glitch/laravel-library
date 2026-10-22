<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    /**
     * Преобразование ресурса жанра в массив.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            // Выведет количество книг только если в контроллере был вызван withCount('books')
            'books_count' => $this->whenCounted('books'),
        ];
    }
}