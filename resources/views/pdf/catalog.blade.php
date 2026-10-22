<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог книг</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; margin: 20px; }
        h1 { text-align: center; color: #1a252f; text-transform: uppercase; font-size: 18px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <h1>Каталог книг</h1>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 40%;">Название</th>
                <th style="width: 25%;">Автор</th>
                <th style="width: 30%;">Жанр</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->genre->name ?? 'Без жанра' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align: center;">Книги отсутствуют</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">Дата формирования: {{ now()->format('d.m.Y H:i') }}</div>
</body>
</html>