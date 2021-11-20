<?php

namespace Database\Seeders;

use Domain\Users\Models\Role;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::factory()->create([
            'first_name' => 'Super Admin',
            'last_name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
        ]);

        $superAdmin->assignRole(Role::ROLES['super_admin']);

        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole(Role::ROLES['admin']);

        $moderator = User::factory()->create([
            'first_name' => 'Moderator',
            'last_name' => 'Moderator',
            'email' => 'moderator@gmail.com',
        ]);
        $moderator->assignRole(Role::ROLES['moderator']);

        $viewer = User::factory()->create([
            'first_name' => 'Viewer',
            'last_name' => 'Viewer',
            'email' => 'viwer@gmail.com',
        ]);
        $viewer->assignRole(Role::ROLES['viewer']);

        $users = User::factory(20)->create();
        foreach ($users as $user) {
            $user->assignRole(Role::ROLES['viewer']);
        }
    }
}
