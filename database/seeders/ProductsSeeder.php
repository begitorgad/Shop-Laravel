<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
/*         $products = [
            ['name' => 'Washing Machine', 'category_id' => 1, 'price' => 499.99, 'stock' => 10],
            ['name' => 'T-Shirt', 'category_id' => 2, 'price' => 19.99, 'stock' => 100],
            ['name' => 'Vacuum Cleaner', 'category_id' => 3, 'price' => 129.99, 'stock' => 20],
            ['name' => 'Smartphone', 'category_id' => 4, 'price' => 699.99, 'stock' => 15],
            ['name' => 'Novel Book', 'category_id' => 5, 'price' => 14.99, 'stock' => 50],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => null,
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image_path' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } */

            Product::factory(30)->create();

    }
}
