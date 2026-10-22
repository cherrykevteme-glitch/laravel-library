<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Support\Facades\Log;

class NotifyAdminsAboutBooking
{
    public function handle(BookingCreated $event): void
    {
        // Логика уведомления администраторов
        Log::info("Администраторы уведомлены о новом бронировании книги ID: {$event->booking->book_id}");
    }
}