<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'series',
        'description',
        'image_path',
        'is_featured',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $product): void {
            if ($product->isDirty('name') && blank($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
