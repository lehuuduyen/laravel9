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
                'title' => "Field news | recruit ",
            ],
            [
                'id' => 2,
                'title' => "Field infomation",
            ],
            [
                'id' => 3,
                'title' => "Field strengths",
            ],
            [
                'id' => 4,
                'title' => "Field works",
            ],
            [
                'id' => 5,
                'title' => "Field  service ",
            ],
            [
                'id' => 6,
                'title' => "Field  company ",
            ],
        ];
        Config_field::insert($Config_field);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
