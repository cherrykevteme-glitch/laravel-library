<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function store(StoreBookRequest $request)
    {
        abort_unless($request->user()->tokenCan('write'), 403, 'Токену не хватает права write');

        $data = $request->validated();

        // Загрузка файла обложки при наличии
        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        $book = Book::create($data + ['user_id' => $request->user()->id]);

        return (new BookResource($book->load('genre')))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        abort_unless($request->user()->tokenCan('write'), 403, 'Токену не хватает права write');
        Gate::authorize('update', $book);

        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return new BookResource($book->load('genre'));
    }

    public function destroy(Request $request, Book $book)
    {
        abort_unless($request->user()->tokenCan('write'), 403, 'Токену не хватает права write');
        Gate::authorize('delete', $book);

        $book->delete();

        return response()->noContent();
    }
}