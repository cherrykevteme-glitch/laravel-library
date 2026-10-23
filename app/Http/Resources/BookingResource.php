<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'book_id' => $this->book_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at->toIso8601String(),
            'book' => new BookResource($this->whenLoaded('book')),
        ];
    }
}