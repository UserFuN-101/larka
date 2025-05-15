<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'category_id' => Category::factory(),
            'photo' => $this->faker->imageUrl,
            'description' => $this->faker->paragraph,
            'short_description' => $this->faker->sentence,
            'keywords' => $this->faker->words(3, true),
            'seo_title' => $this->faker->sentence,
        ];
    }
}