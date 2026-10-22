<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог книг</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Каталог книг</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($books as $book)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:underline">
                            {{ $book->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-2">Автор: {{ $book->author }}</p>
                    <p class="text-gray-500 text-sm mb-4">Год: {{ $book->year }}</p>
                    <a href="{{ route('books.show', $book) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Подробнее / Забронировать
                    </a>
                </div>
            @empty
                <p class="text-gray-500">Книги пока не добавлены.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
</body>
</html>