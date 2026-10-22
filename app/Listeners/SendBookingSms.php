<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Support\Facades\Log;

class SendBookingSms
{
    public function handle(BookingCreated $event): void
    {
        // Логика отправки SMS на номер $event->booking->phone
        Log::info("SMS отправлено на номер {$event->booking->phone}");
    }
}