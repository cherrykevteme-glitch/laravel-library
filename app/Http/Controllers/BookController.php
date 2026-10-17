<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sort = in_array($request->sort, ['title', 'year']) ? $request->sort : 'title';

        $books = Book::with('genre')
            ->search($request->q)
            ->when($request->genre, fn ($q, $g) => $q->where('genre_id', $g))
            ->orderBy($sort)
            ->paginate(9)
            ->withQueryString();

        $genres = Genre::withCount('books')->orderBy('name')->get();

        return view('books.index', compact('books', 'genres'));
    }

    public function show(Book $book)
    {
        // Получаем похожие книги из той же категории (исключая текущую)
        $relatedBooks = $book->genre->books()
            ->where('id', '!=', $book->id)
            ->take(3)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }
}