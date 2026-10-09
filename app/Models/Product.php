<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'image', 'images', 'finish', 'dimensions', 'size', 'weight', 'description', 'price', 'is_active', 'is_featured', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'images' => 'array',
    ];

    public function coverUrl(): string
    {
        $uploaded = $this->image;
        if ($uploaded && \Illuminate\Support\Facades\Storage::disk('public')->exists($uploaded)) {
            return asset('storage/' . $uploaded);
        }

        $slug = $this->category->slug ?? '';
        $fallback = match ($slug) {
            'copper' => 'images/copper.webp',
            'brass' => 'images/brass.webp',
            'kasa' => 'images/khasaimage.webp',
            'steel' => 'images/steelimage.webp',
            'aluminium' => 'images/aluminium.webp',
            default => null,
        };

        return $fallback ? asset($fallback) : asset('images/placeholder-product.svg');
    }

    public function galleryUrls(): array
    {
        $urls = [$this->coverUrl()];

        $extra = collect($this->images ?? [])
            ->filter()
            ->take(5)
            ->map(fn ($path) => asset('storage/' . ltrim($path, '/')))
            ->all();

        $urls = array_merge($urls, $extra);

        return array_slice($urls, 0, 6);
    }

    public function getDimensionsDisplayAttribute(): string
    {
        $value = (string) ($this->dimensions ?? '');
        if ($value === '') {
            return '';
        }

        if (preg_match('/(\d+(?:\.\d+)?)\s*(cm|mm|m|in)?\s*[x×]\s*(\d+(?:\.\d+)?)\s*(cm|mm|m|in)?/i', $value, $matches)) {
            $a = $matches[1];
            $unit = $matches[2] ?? $matches[4] ?? '';
            $b = $matches[3];

            return trim($a . ' × ' . $b . ' ' . $unit);
        }

        return $value;
    }

    public function getWeightDisplayAttribute(): string
    {
        $value = (string) ($this->weight ?? '');
        if ($value === '') {
            return '';
        }

        return preg_replace('/(\d+(?:\.\d+)?)\s*(kg|g|mg|l|ml)/i', '$1 $2', $value) ?? $value;
    }

    public function metaLine(): string
    {
        $parts = array_filter([
            $this->size ?: null,
            $this->weight_display ?: null,
        ]);

        return implode(' · ', $parts);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
