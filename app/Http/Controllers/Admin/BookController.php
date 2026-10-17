<?php

namespace App\Http\Controllers\Admin;

class BookController extends Controller
{
    public function index()
    {
        $catalog = config('catalog', []);

        $books = [];

        foreach ($catalog as $id => $book) {
            $book['id'] = $id;
            $books[] = $book;
        }

        return view('books', compact('books'));
    }

    public function show(int $id)
    {
        $catalog = config('catalog', []);

        $book = $catalog[$id] ?? null;

        abort_if($book === null, 404);

        $book['id'] = $id;

        return view('books.show', compact('book', 'id'));
    }
}