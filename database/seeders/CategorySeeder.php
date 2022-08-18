<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [[
            'id' => 1,
            'name' => "Banner Top",
            'slug' => "banner_top",
            'img_pc' => "1660706561_Xbf_imagename.png",
            'img_sp' => "1660706561_Xbf_imagename.png",
            'status' => 2,

        ],
        [
            'id' => 2,
            'name' => "About",
            'slug' => "about",
            'img_pc' => "",
            'img_sp' => "",
            'status' => 2,

        ],
        [
            'id' => 3,
            'name' => "Service",
            'slug' => "services",
            'img_pc' => "",
            'img_sp' => "",
            'status' => 1,

        ],
        [
            'id' => 4,
            'name' => "Strengths",
            'slug' => "strengths",
            'img_pc' => "",
            'img_sp' => "",
            'status' => 2,

        ],
        [
            'id' => 5,
            'name' => "Works",
            'slug' => "works",
            'img_pc' => "",
            'img_sp' => "",
            'status' => 1,

        ],
        [
            'id' => 6,
            'name' => "News",
            'slug' => "news",
            'img_pc' => "",
            'img_sp' => "",
            'status' => 1,

        ],
    ];
        Category::insert($category);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
