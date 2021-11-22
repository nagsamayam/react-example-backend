<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Orders\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{

    protected $model = OrderItem::class;


    public function definition()
    {
        return [
            'product_title' => $this->faker->name,
            'price' => $this->faker->numberBetween(10, 100),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
