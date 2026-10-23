<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1. Форма ввода пин-кода
    public function loginForm()
    {
        return view('admin.login');
    }

    // 2. Проверка пин-кода и сохранение в сессию
    public function checkPin(Request $request)
    {
        if ($request->input('pin') === '1234') {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.books.index');
        }

        return back()->withErrors(['pin' => 'Неверный пин-код!']);
    }

    // 3. Выход из админки
    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('home');
    }

    // 4. Главная страница админки со списком книг
    public function index()
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $books = Book::latest()->paginate(10);
        return view('admin.index', compact('books'));
    }

    // 5. Форма редактирования книги
    public function edit(Book $book)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        return view('admin.edit', compact('book'));
    }

    // 6. Обновление книги
    public function update(Request $request, Book$book)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $validated =$request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'year'        => ['required', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена!');
    }

    // 7. Удаление книги
    public function destroy(Book $book)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно удалена!');
    }
}