<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'category_id' => $this->faker->numberBetween(1, 5), // your seeded categories
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->optional()->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 999),
            'stock' => $this->faker->numberBetween(0, 200),
            'image' => null,
            'active' => $this->faker->boolean(90),
            'discount' => $this->faker->numberBetween(0,99),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function outOfStock(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    public function inactive(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    public function expensive(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'price' => fake()->randomFloat(2, 500, 2000),
        ]);
    }

    public function featured(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'discount' =>  fake()->randomInteger(30, 90),
            'stock' => $this->faker->randomInteger(1,500)
        ]);
    }
}