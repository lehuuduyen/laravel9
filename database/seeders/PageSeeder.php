<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = [[
            'id' => 1,
            'slug' => "banner_top",
            'status' => 2,

        ],
        [
            'id' => 2,
            'slug' => "about",
            'status' => 2,

        ],
        [
            'id' => 3,
            'slug' => "services",
            'status' => 1,

        ],
        [
            'id' => 4,
            'slug' => "strengths",
            'status' => 2,

        ],
        [
            'id' => 5,
            'slug' => "works",
            'status' => 1,

        ],
        [
            'id' => 6,
            'slug' => "news",
            'status' => 1,

        ],
    ];
        Page::insert($page);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
