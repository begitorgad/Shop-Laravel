<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => 499.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 5,
                'quantity' => 2,
                'unit_price' => 14.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}