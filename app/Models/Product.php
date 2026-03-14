<?php

namespace App\Models;

// use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Relations\MorphMany;
Use App\Models\Comment;
use App\Rules\Slug;


class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'active',
        'discount'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'active' => 'boolean',
        'discount' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeStocker(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeCheap(Builder $query): Builder
    {
        return $query->where('price', '<', 15);
    }

    public function scopeCategory(Builder $query, int|array $category_id): Builder
    {
        return is_array($category_id)
        ? $query->whereIn('category_id', $category_id)
        : $query->where('category_id', $category_id);
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () =>number_format((float) $this->price, 2, ',', ' ').'$',
        );  
    }

    protected function discountedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () =>
                $this->discount > 0
                    ? round($this->price * (1 - $this->discount / 100), 2)
                    : $this->price
        );
    }

    protected function formattedDiscountedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () =>
            number_format($this->discounted_price, 2).' $'
            );
    }


/*     protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => [
                'name' => $value,
                'slug' => Str::slug($value),
            ],
        );
    } */

    protected function stockLabel(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>
                $value < 1 ? 'Out of stock'
                : ($value < 5 ? 'Limited stock' : 'In stock')
        );
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }


}