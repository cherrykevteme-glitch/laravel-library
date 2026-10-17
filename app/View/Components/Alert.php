<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(public string $type = 'info') {}

    public function icon(): string
    {
        return match ($this->type) {
            'success' => '✔',
            'error'   => '✖',
            'warning' => '⚠',
            default   => 'ℹ',
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}