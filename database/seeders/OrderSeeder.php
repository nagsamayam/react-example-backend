<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Orders\Models\Order;
use Domain\Orders\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(30)->create()->each(function (Order $order) {
            OrderItem::factory(random_int(1, 5))->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
