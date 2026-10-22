<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Список всех жанров с количеством связанных книг (Задание 2).
     */
    public function index()
    {
        $genres = Genre::withCount('books')->get();
        
        return GenreResource::collection($genres);
    }

    /**
     * Список книг конкретного жанра с пагинацией (Задание 2).
     */
    public function books(Genre $genre)
    {
        $books = $genre->books()->with('genre')->paginate(10);
        
        return BookResource::collection($books);
    }
}