<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Список всех книг с пагинацией
    public function index()
    {
        $books = Book::latest()->paginate(9);
        return view('books.index', compact('books'));
    }

    // Форма добавления книги
    public function create()
    {
        return view('books.create');
    }

    // Сохранение новой книги
    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'year'        => ['required', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        // Указываем дефолтный genre_id, чтобы база данных не выдавала ошибку NOT NULL
        $validated['genre_id'] = 1;

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Книга успешно добавлена в каталог!');
    }

    // Просмотр одной книги (детально)
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Сохранение бронирования
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'phone'   => ['required', 'string', 'max:20'],
        ]);

        $existingBooking = Booking::where('book_id', $validated['book_id'])
            ->where('phone', $validated['phone'])
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['phone' => 'Вы уже оставляли заявку на эту книгу.']);
        }

        $userId = auth()->id();
        if (!$userId) {
            $firstUser = User::first();
            $userId = $firstUser ? $firstUser->id : 1;
        }

        Booking::create([
            'user_id' => $userId,
            'book_id' => $validated['book_id'],
            'phone'   => $validated['phone'],
        ]);

        return redirect()->back()->with('success', 'Заявка на бронирование успешно оформлена!');
    }
}