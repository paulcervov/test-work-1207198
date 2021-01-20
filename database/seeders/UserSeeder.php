<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $roles = Role::all();

        User::factory()->create([
            'email' => 'admin@example.com',
            'role_id' => $roles->firstWhere('name', 'Admin')->id
        ]);

        User::factory()->create([
            'email' => 'editor@example.com',
            'role_id' => $roles->firstWhere('name', 'Editor')->id
        ]);

        User::factory()->create([
            'email' => 'author@example.com',
            'role_id' => $roles->firstWhere('name', 'Author')->id
        ]);

        User::factory(10)
            ->make(['role_id' => null])
            ->each(function (User $user) use ($roles) {
                $user->role_id = $roles->random()->id;
                $user->save();
            });
    }
}
