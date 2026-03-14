<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'new',        'slug' =>    Str::slug('new'),         'created_at' => now(), 'updated_at' => now()],
            ['name' => 'sale',       'slug' =>    Str::slug('sale'),        'created_at' => now(), 'updated_at' => now()],
            ['name' => 'popular',    'slug' =>    Str::slug('popular'),     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'limited',    'slug' =>    Str::slug('limited'),     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'eco',        'slug' =>    Str::slug('eco'),         'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}