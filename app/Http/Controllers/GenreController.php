<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('books')->orderBy('name')->get();
        return view('genres.index', compact('genres'));
    }

    public function show(Genre $genre)
    {
        // Загружаем книги данного жанра с пагинацией
        $books = $genre->books()->with('genre')->paginate(9);

        return view('genres.show', compact('genre', 'books'));
    }
