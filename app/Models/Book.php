<?php
namespace  App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id', 
        'title', 
        'author', 
        'year', 
        'pages', 
        'price', 
        'description', 
        'is_available'
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'year' => 'integer',
            'pages' => 'integer',
            'price' => 'decimal:2',
        ];
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopeAvailable(Builder $query): void
    {
        $query->where('is_available', true);
    }

    public function scopeSearch(Builder $query, ?string $text): void
    {
        $query->when($text, function ($q) use ($text) {
            $q->where(fn ($w) => $w->where('title', 'like', "%{$text}%")
                                  ->orWhere('author', 'like', "%{$text}%"));
        });
    }
}