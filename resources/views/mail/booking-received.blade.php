<x-mail::message>
# Здравствуйте, {{ $booking->user->name }}!

Ваша заявка на «{{ $booking->book->title }}» принята.
Мы свяжемся с вами по номеру {{ $booking->phone }}.

<x-mail::button :url="route('profile')">
Мои заявки
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>