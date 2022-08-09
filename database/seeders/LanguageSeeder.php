<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = [[
            'id' => 1,
            'name' => "English",
            'slug' => "eng",
        ],
        [
            'id' => 2,
            'name' => "Japan",
            'slug' => "jp",
        ]];
        Language::insert($language);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
