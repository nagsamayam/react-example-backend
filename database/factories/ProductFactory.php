<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->numberBetween(10, 100),
        ];
    }
}
