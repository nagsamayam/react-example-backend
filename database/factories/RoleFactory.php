<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Users\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

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
