<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => [
                'name' => $value,
                'slug' => Str::slug($value),
            ],
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getColorAttribute(): string
    {
        $colors = ['#3490dc', '#38c172', '#aba15a', '#e3342f', '#9561e2'];
        return $colors[$this->id % count($colors)];
    }
}
