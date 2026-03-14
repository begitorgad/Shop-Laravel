<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Image;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Product::whereNotNull('image')->each(function ($product) {
            $product->image()->create([
                'path' => $product->image,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Image::where('imageable_type', \App\Models\Product::class)->delete();
    }
};
