<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('books')->orderBy('name')->paginate(15);
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genres,name'],
        ], [
            'name.required' => 'Укажите название жанра.',
            'name.unique'   => 'Такой жанр уже существует.',
        ]);

        Genre::create($data);
        return redirect()->route('admin.genres.index')->with('success', 'Жанр успешно добавлен');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genres,name,' . $genre->id],
        ], [
            'name.required' => 'Укажите название жанра.',
            'name.unique'   => 'Такой жанр уже существует.',
        ]);

        $genre->update($data);
        return redirect()->route('admin.genres.index')->with('success', 'Жанр успешно обновлен');
    }

    public function destroy(Genre $genre)
    {
        // Запрет удаления, если есть связанные книги
        if ($genre->books()->exists()) {
            return back()->with('error', 'Нельзя удалить: есть связанные записи (книги).');
        }

        $genre->delete();
        return back()->with('success', 'Жанр успешно удален');
    }
}