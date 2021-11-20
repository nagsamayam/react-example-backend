<?php

namespace Database\Seeders;

use Domain\Users\Models\Permission;
use Domain\Users\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::factory()->create(['name' => Role::ROLES['super_admin']]);
        $adminRole = Role::factory()->create(['name' => Role::ROLES['admin']]);
        $moderatorRole = Role::factory()->create(['name' => Role::ROLES['moderator']]);
        $viewerRole =  Role::factory()->create(['name' => Role::ROLES['viewer']]);

        $permissionIds = Permission::select('id')->pluck('id');
        $superAdminRole->permissions()->attach($permissionIds);
        $adminRole->permissions()->attach($permissionIds);

        $moderatorRole->permissions()->attach($permissionIds);
        $moderatorRole->permissions()->detach(4);

        $viewerRole->permissions()->attach([1, 3, 5, 7,]);
    }
}
