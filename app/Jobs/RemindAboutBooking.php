<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class RemindAboutBooking implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(public Booking $booking) {}

    public function handle(): void
    {
        // Проверяем статус (например, если заявка всё ещё актуальна)
        Log::info("Напоминание: Заявка №{$this->booking->id} ожидает обработки!");
    }
}