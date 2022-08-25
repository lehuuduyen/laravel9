<?php

namespace Database\Seeders;

use App\Models\Config_field;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigFieldSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Config_field = [
            [
            'id' => 1,
            'title' => "Default",
            ],
            [
                'id' => 2,
                'title' => "Field news",
                ],
        ];
        Config_field::insert($Config_field);
        // \App\Models\Language::factory()->count(30)->create();

    }
}