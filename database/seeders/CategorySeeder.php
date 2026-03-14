<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Appliance',
                'slug' => 'appliance',
                'description'=> 'No, women aren\'t listed here. This category is for home and kitchen appliances only.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clothes',
                'slug' => 'clothes',
                'description'=> '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Household',
                'slug' => 'household',
                'description'=> 'Wow this is kinda like appliance but for cleaning and stuff.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Gadgets',
                'slug' => 'gadgets',
                'description'=> 'Phones, tablets, laptops, and other electronic devices. Nothing to do with the inspector.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'description'=> 'Fiction, non-fiction, educational materials, and more.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}