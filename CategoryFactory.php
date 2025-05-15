<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
          'name' => $this->faker->word,
          'photo' => $this->faker->imageUrl,
          'description' => $this->faker->paragraph,
          'short_description' => $this->faker->sentence,
          'keywords' => $this->faker->words(3, true),
          'seo_title' => $this->faker->sentence,
        ];
    }
}