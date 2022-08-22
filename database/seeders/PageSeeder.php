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
            'name' => "Banner Top",
            'slug' => "banner_top",
            'status' => 2,

        ],
        [
            'id' => 2,
            'name' => "About",
            'slug' => "about",
            'status' => 2,

        ],
        [
            'id' => 3,
            'name' => "Service",
            'slug' => "services",
            'status' => 1,

        ],
        [
            'id' => 4,
            'name' => "Strengths",
            'slug' => "strengths",
            'status' => 2,

        ],
        [
            'id' => 5,
            'name' => "Works",
            'slug' => "works",
            'status' => 1,

        ],
        [
            'id' => 6,
            'name' => "News",
            'slug' => "news",
            'status' => 1,

        ],
    ];
        Page::insert($page);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
