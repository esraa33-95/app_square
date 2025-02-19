<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

class ProductFactory extends Factory
{
    protected $model = Product::class; // ✅ Define the model

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), 
            'price' => $this->faker->randomFloat(2, 10, 500),
            'image' => 'https://picsum.photos/200/200?random=' . rand(1, 10), 
            'description' => $this->faker->sentence(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(), 
        ];
    }
}
