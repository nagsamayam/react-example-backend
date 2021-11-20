<?php

namespace Database\Seeders;

use Domain\Users\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'view_users', 'guard_name' => 'sanctum'],
            ['name' => 'edit_users', 'guard_name' => 'sanctum'],
            ['name' => 'view_roles', 'guard_name' => 'sanctum'],
            ['name' => 'edit_roles', 'guard_name' => 'sanctum'],
            ['name' => 'view_products', 'guard_name' => 'sanctum'],
            ['name' => 'edit_products', 'guard_name' => 'sanctum'],
            ['name' => 'view_orders', 'guard_name' => 'sanctum'],
            ['name' => 'edit_orders', 'guard_name' => 'sanctum'],
        ]);
    }
}
