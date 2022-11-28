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
            'is_category'=>2


        ],
        [
            'id' => 2,
            'slug' => "company",
            'status' => 1,
            'is_category'=>1


        ],
        [
            'id' => 3,
            'slug' => "service",
            'status' => 1,
            'is_category'=>1

        ],
        [
            'id' => 4,
            'slug' => "strengths",
            'status' => 1,
            'is_category'=>1

        ],
        [
            'id' => 5,
            'slug' => "works",
            'status' => 1,
            'is_category'=>1

        ],
        [
            'id' => 6,
            'slug' => "news",
            'status' => 1,
            'is_category'=>1

        ],
        [
            'id' => 7,
            'slug' => "recruit",
            'status' => 1,
            'is_category'=>1

        ],
        [
            'id' => 8,
            'slug' => "contact",
            'status' => 2,
            'is_category'=>2


        ],
        [
            'id' => 9,
            'slug' => "security",
            'status' => 2,
            'is_category'=>2


        ],
        [
            'id' => 10,
            'slug' => "privacy",
            'status' => 2,
            'is_category'=>2

        ]
        ,
        [
            'id' => 11,
            'slug' => "information",
            'status' => 3,
            'is_category'=>2

        ]
        
    ];
        Page::insert($page);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
