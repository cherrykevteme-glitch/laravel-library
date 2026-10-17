<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Каталог книг
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    // Просмотр одной книги
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Форма добавления книги
    public function create()
    {
        return view('admin.books.create');
    }

    // Сохранение новой книги
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book = new Book();
        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->description = $data['description'] ?? null;
        $book->save();

        return redirect()->route('books.index')
            ->with('success', 'Книга успешно добавлена!');
    }

    // Форма редактирования книги
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    // Сохранение изменений
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->description = $data['description'] ?? null;
        $book->save();

        return redirect()->route('books.index')
            ->with('success', 'Книга успешно обновлена!');
    }

    // Удаление книги
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Книга успешно удалена!');
    }
}