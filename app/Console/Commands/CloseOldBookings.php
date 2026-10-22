<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CloseOldBookings extends Command
{
    protected $signature = 'bookings:close-old
                            {--days=7 : Через сколько дней заявка устаревает}
                            {--dry-run : Только показать, ничего не менять}';

    protected $description = 'Закрывает необработанные заявки старше N дней';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $old = Booking::with('user')->where('status', 'new')
            ->where('created_at', '<', now()->subDays($days))->get();

        if ($old->isEmpty()) {
            $this->info('Устаревших заявок нет.');
            return self::SUCCESS;
        }

        $this->table(['№', 'Пользователь', 'Дата создания'],
            $old->map(fn ($b) => [$b->id, $b->user->name ?? 'Гость', $b->created_at->format('d.m.Y')]));

        if ($this->option('dry-run') || ! $this->confirm("Закрыть {$old->count()} заявок?", true)) {
            $this->info('Отменено или режим dry-run.');
            return self::SUCCESS;
        }

        $this->withProgressBar($old, fn ($b) => $b->update(['status' => 'expired']));
        $this->newLine();
        $this->info('Устаревшие заявки успешно закрыты!');

        return self::SUCCESS;
    }
}