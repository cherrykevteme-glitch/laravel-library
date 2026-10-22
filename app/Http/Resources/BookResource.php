<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Преобразование ресурса модели в массив для клиента.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'author'     => $this->author,
            'year'       => $this->year,
            'available'  => $this->is_available, // Переименованное поле для удобства клиента
            'cover'      => $this->cover_url,      // Аксессор картинки (из ЛР №8)
            // Вложенный ресурс подгрузится только если связь была загружена через with() (избегаем N+1)
            'genre'      => new GenreResource($this->whenLoaded('genre')),
            'created_at' => $this->created_at?->toIso8601String(), // Безопасное форматирование даты
            'links'      => [
                'self' => route('api.v1.books.show', $this->id),
            ],
        ];
    }
}