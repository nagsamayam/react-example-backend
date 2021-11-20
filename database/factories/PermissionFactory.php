<?php

namespace Database\Factories;

use Domain\Users\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'guard_name' => 'sanctum',
            'name' => $this->faker->name,
        ];
    }
}
