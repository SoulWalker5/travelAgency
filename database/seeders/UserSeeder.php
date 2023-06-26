<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->createMany([
            [
                'name' => 'User',
                'email' => 'user@example.com',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
            ],
        ])->each(function (User $user) {
            if ($user->name === 'Admin') {
                $role = Role::where('name', Role::ADMIN)->first()->id;
            } else {
                $role = Role::where('name', Role::EDITOR)->first()->id;
            }

            $user->roles()->attach([$role]);
        });
    }
}
