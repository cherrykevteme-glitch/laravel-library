<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('genre');

        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        $books = $query->orderBy('title')->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.books.create', compact('genres'));
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        $data['user_id'] = $request->user() ? $request->user()->id : 1;

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно добавлена');
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('admin.books.edit', compact('book', 'genres'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('attachment')) {
            if ($book->attachment) {
                Storage::disk('local')->delete($book->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Изменения сохранены');
    }

    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        if ($book->attachment) {
            Storage::disk('local')->delete($book->attachment);
        }

        $book->delete();

        return back()->with('success', 'Книга удалена');
    }

    public function pdf(Request $request)
    {
        $query = Book::with('genre');
        
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }
        
        $books = $query->orderBy('title')->get();

        return Pdf::loadView('pdf.catalog', compact('books'))
            ->setPaper('a4')
            ->download('catalog-' . now()->format('Y-m-d') . '.pdf');
    }
}