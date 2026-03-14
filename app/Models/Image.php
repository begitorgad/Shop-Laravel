<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Image extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'path'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

}