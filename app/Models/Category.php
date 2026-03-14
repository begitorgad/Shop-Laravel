<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function popularTags(int $limit = 5)
    {
        return Tag::whereHas('products', fn ($q) => $q->where('category_id', $this->id))
            ->withCount(['products as total' => fn ($q) => $q->where('category_id', $this->id)])
            ->orderByDesc('total')
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }
}