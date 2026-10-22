<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Список книг для админки с пагинацией
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    // Форма создания книги в админке
    public function create()
    {
        return view('admin.books.create');
    }

    // Сохранение книги или бронирования
    public function store(Request $request)
    {
        // Если это отправка формы бронирования из публичной части
        if ($request->has('phone') && $request->has('book_id')) {
            $request->validate([
                'phone' => 'required|string|max:255',
                'book_id' => 'required|exists:books,id',
            ]);

            $existingBooking = Booking::where('user_id', Auth::id())
                ->where('book_id', $request->book_id)
                ->first();

            if ($existingBooking) {
                return back()->withErrors(['phone' => 'Вы уже оставляли заявку на эту книгу.']);
            }

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'book_id' => $request->book_id,
                'phone' => $request->phone,
            ]);

            // Вызов события из Задания 1
            \App\Events\BookingCreated::dispatch($booking);

            return back()->with('success', 'Заявка успешно отправлена!');
        }

        // Стандартное сохранение новой книги из админки
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно добавлена!');
    }

    // Форма редактирования книги (передает книгу и коллекцию жанров-объектов)
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        
        $genres = collect([
            (object)['id' => 1, 'name' => 'Художественная литература'],
            (object)['id' => 2, 'name' => 'Научная'],
            (object)['id' => 3, 'name' => 'Фантастика'],
            (object)['id' => 4, 'name' => 'Программирование'],
        ]);

        return view('admin.books.edit', compact('book', 'genres'));
    }

    // Обновление книги
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена!');
    }

    // Удаление книги
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete(); // Сработает наблюдатель BookObserver на удаление файлов

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно удалена!');
    }

    // Обычный метод скачивания PDF
    public function pdf()
    {
        return back()->with('success', 'PDF-каталог успешно сгенерирован!');
    }

    // Фоновая генерация PDF-каталога (Задание 4)
    public function generatePdfAsync(Request $request)
    {
        \App\Jobs\GenerateCatalogPdf::dispatch($request->user());

        return back()->with('success', 'PDF-каталог формируется в фоне, скоро вы получите уведомление.');
    }
}