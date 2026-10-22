<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Список записей с фильтрацией, поиском, сортировкой и пагинацией.
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'q'        => ['nullable', 'string', 'max:100'],
            'genre'    => ['nullable', 'integer', 'exists:genres,id'],
            'sort'     => ['nullable', 'in:title,year,-year'],
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ]);

        $sort  = $data['sort'] ?? 'title';
        
        $books = Book::with('genre')
            ->search($data['q'] ?? null)
            ->when($data['genre'] ?? null, fn ($q, $g) => $q->where('genre_id', $g))
            ->orderBy(ltrim($sort, '-'), str_starts_with($sort, '-') ? 'desc' : 'asc')
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return BookResource::collection($books);
    }

    /**
     * Показ одной конкретной записи.
     */
    public function show(Book $book)
    {
        return new BookResource($book->load('genre'));
    }

    /**
     * Случайная запись (Задание 4).
     */
    public function random()
    {
        $book = Book::with('genre')->inRandomOrder()->first();

        if (!$book) {
            return response()->json(['message' => 'Записи не найдены'], 404);
        }

        return new BookResource($book);
    }

    /**
     * Статистика каталога с кэшированием (Задание 4).
     */
    public function stats()
    {
        $stats = Cache::remember('api_books_stats', 300, function () {
            return [
                'total_books' => Book::count(),
                'last_added'  => Book::latest()->value('created_at')?->toIso8601String(),
            ];
        });

        return response()->json($stats);
    }
}