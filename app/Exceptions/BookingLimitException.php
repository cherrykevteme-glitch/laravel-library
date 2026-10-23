<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingLimitException extends Exception
{
    public function __construct(public int $limit)
    {
        parent::__construct(__('Active bookings limit exceeded (:limit)', ['limit' => $limit]));
    }

    public function report(): void
    {
        Log::channel('bookings')->warning($this->getMessage(), ['user_id' => auth()->id()]);
    }

    public function render(Request $request)
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => $this->getMessage()], 409);
        }

        return back()->withInput()->with('error', $this->getMessage());
    }
}
```[cite: 10]

3. Создайте простую кастомную страницу ошибки **`resources/views/errors/500.blade.php`** (без вызовов базы данных)[cite: 10]:
```html
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ошибка сервера</title>
</head>
<body style="font-family: sans-serif; text-align: center; padding-top: 50px;">
    <h1>Что-то пошло не так</h1>
    <p>Мы уже разбираемся с этой проблемой. Пожалуйста, вернитесь на главную страницу.</p>
    <a href="{{ url('/') }}">На главную</a>
</body>
</html>
```[cite: 10]

---

### Шаг 6. Фиксация изменений в Git

После проверки работы всех компонентов на локальном сервере отправьте код в репозиторий[cite: 10]:

```bash
git add .
git commit -m "ЛР14: локализация, журналы, исключения"
git push
```[cite: 10]