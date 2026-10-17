@foreach ($books as $book)
    <x-card :title="$book->title"
            :url="route('books.show', $book->id)"
            :badge="$book->year < 1950 ? 'Классика' : null"
            class="card-wide">
        {{ $book->author }}, {{ $book->year }}
    </x-card>
@endforeach