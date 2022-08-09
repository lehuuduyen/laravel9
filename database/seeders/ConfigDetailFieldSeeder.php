<?php

namespace Database\Seeders;

use App\Models\Config_detail_field;
use App\Models\Config_field;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigDetailFieldSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Config_detail_field = [
            [
                'id' => 1,
                'config_field_id' => 1,
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 2,
                'config_field_id' => 1,
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 3,
                'config_field_id' => 1,
                'language_id' => 1,
                'title' => "Image PC",
                'key' => "img_pc",
                'type' => 3,
            ],
            [
                'id' => 4,
                'config_field_id' => 1,
                'language_id' => 1,
                'title' => "Slug",
                'key' => "slug",
                'type' => 1,
            ],
            [
                'id' => 5,
                'config_field_id' => 1,
                'language_id' => 1,
                'title' => "Image SP",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 6,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 7,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 8,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Image PC",
                'key' => "img_pc",
                'type' => 3,
            ],
            [
                'id' => 9,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Slug",
                'key' => "slug",
                'type' => 1,
            ],
            [
                'id' => 10,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Image SP",
                'key' => "img_sp",
                'type' => 3,
            ],
        ];
        Config_detail_field::insert($Config_detail_field);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
