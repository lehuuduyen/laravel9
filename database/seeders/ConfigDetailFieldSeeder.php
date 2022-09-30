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
                'title' => "Title jp",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 7,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Excerpt jp",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 8,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Image PC Jp",
                'key' => "img_pc",
                'type' => 3,
            ],
          
            [
                'id' => 10,
                'config_field_id' => 1,
                'language_id' => 2,
                'title' => "Image SP Jp",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 11,
                'config_field_id' => 2,
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 12,
                'config_field_id' => 2,
                'language_id' => 2,
                'title' => "Title Jp",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 13,
                'config_field_id' => 2,
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 14,
                'config_field_id' => 2,
                'language_id' => 2,
                'title' => "Excerpt Jp",
                'key' => "excerpt",
                'type' => 2,
            ],
            


            [
                'id' => 15,
                'config_field_id' => 3,
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 16,
                'config_field_id' => 3,
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 17,
                'config_field_id' => 3,
                'language_id' => 1,
                'title' => "Image PC",
                'key' => "img_pc",
                'type' => 3,
            ],
            [
                'id' => 18,
                'config_field_id' => 3,
                'language_id' => 1,
                'title' => "Image SP",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 19,
                'config_field_id' => 3,
                'language_id' => 2,
                'title' => "Title jp",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 20,
                'config_field_id' => 3,
                'language_id' => 2,
                'title' => "Excerpt jp",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 21,
                'config_field_id' => 3,
                'language_id' => 2,
                'title' => "Image PC Jp",
                'key' => "img_pc",
                'type' => 3,
            ],
          
            [
                'id' => 22,
                'config_field_id' => 3,
                'language_id' => 2,
                'title' => "Image SP Jp",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 23,
                'config_field_id' => 4,
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 24,
                'config_field_id' => 4,
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 25,
                'config_field_id' => 4,
                'language_id' => 1,
                'title' => "Sub Title",
                'key' => "sub_title",
                'type' => 1,
            ],
            [
                'id' => 26,
                'config_field_id' => 4,
                'language_id' => 2,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 27,
                'config_field_id' => 4,
                'language_id' => 2,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 28,
                'config_field_id' => 4,
                'language_id' => 2,
                'title' => "Sub Title",
                'key' => "sub_title",
                'type' => 2,
            ],
        ];
        Config_detail_field::insert($Config_detail_field);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
