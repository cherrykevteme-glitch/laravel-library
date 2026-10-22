<form method="POST" action="{{ $action }}">
    @csrf
    @isset($book)
        @method('PUT')
    @endisset

    <div style="margin-bottom: 15px;">
        <label>Название</label><br>
        <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}" style="width: 100%; padding: 8px;"
               @class(['invalid' => $errors->has('title')])>
        @error('title') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label>Жанр</label><br>
        <select name="genre_id" style="width: 100%; padding: 8px;" @class(['invalid' => $errors->has('genre_id')])>
            <option value="">-- Выберите жанр --</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @selected(old('genre_id', $book->genre_id ?? '') == $genre->id)>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
        @error('genre_id') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label>Автор</label><br>
        <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}" style="width: 100%; padding: 8px;"
               @class(['invalid' => $errors->has('author')])>
        @error('author') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label>Год издания</label><br>
        <input type="number" name="year" value="{{ old('year', $book->year ?? '') }}" style="width: 100%; padding: 8px;"
               @class(['invalid' => $errors->has('year')])>
        @error('year') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label>Описание</label><br>
        <textarea name="description" style="width: 100%; padding: 8px;" @class(['invalid' => $errors->has('description')])>{{ old('description', $book->description ?? '') }}</textarea>
        @error('description') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label>
            <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $book->is_available ?? true))>
            В наличии
        </label>
    </div>

    <button type="submit" style="padding: 10px 20px;">Сохранить</button>
</form>