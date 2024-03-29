<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use PageTransiations;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Model::unguard();
        $this->call(UserSeeder::class);
        $this->call(ConfigFieldSeeder::class);
        $this->call(LanguageSeeder::class);

        $this->call(ConfigDetailFieldSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PageTransiationsSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(PageConfigFiledSeeder::class);
        
        
        Model::reguard();
    }
}
