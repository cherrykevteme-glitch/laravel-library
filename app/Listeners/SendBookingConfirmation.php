<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendBookingConfirmation implements ShouldQueue // <-- Добавили ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        sleep(3); // Имитация медленной почты
        Log::info("Отправлено письмо подтверждения для бронирования #{$event->booking->id}");
    }
}