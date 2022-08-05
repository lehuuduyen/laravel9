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
        $user = [[
            'id' => 1,
            'name' => "le huu duyen",
            'email' => "lehuuduyen96@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$rE9hfwcTgZAeoCgQZhZCguDbqToZXjTU/3RL6PKk/tGs347aggIxu', // password
        ]];
        User::insert($user);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
