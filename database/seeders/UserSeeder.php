<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'email' => 'admin@example.com',
            'role_id' => User::ID_ROLE_ADMINISTRATOR,
            'deleted_at' => null,
        ]);

        User::factory()->create([
            'email' => 'editor@example.com',
            'role_id' => User::ID_ROLE_EDITOR,
            'deleted_at' => null,
        ]);

        User::factory()->create([
            'email' => 'author@example.com',
            'role_id' => User::ID_ROLE_AUTHOR,
            'deleted_at' => null,
        ]);

        User::factory(10)->create();
    }
}
