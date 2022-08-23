<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Page_transiation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageTransiationsSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PageTransiations = [
            [
                'id' => 1,
                'page_id' => 1,
                'language_id' => 1,
                'title' => "ICD Vietnam for offshore development in Vietnam",
                
            ],
            [
                'id' => 2,
                'page_id' => 1,
                'language_id' => 2,
                'title' => "ベトナムのオフショア開発ならICD Vietnam",
                
            ],

            [
                'id' => 3,
                'page_id' => 2,
                'language_id' => 1,
                'title' => "ABOUT US",
            ],
            [
                'id' => 4,
                'page_id' => 2,
                'language_id' => 2,
                'title' => "ABOUT US",
            
            ],
            [
                'id' => 5,
                'page_id' => 3,
                'language_id' => 1,
                'title' => "SERVICES",
                
            ],
            [
                'id' => 6,
                'page_id' => 3,
                'language_id' => 2,
                'title' => "SERVICES",
                
            ],
            [
                'id' => 7,
                'page_id' => 4,
                'language_id' => 1,
                'title' => "STRENGTHS",
                
            ],
            [
                'id' => 8,
                'page_id' => 4,
                'language_id' => 2,
                'title' => "STRENGTHS",
                
            ],
            [
                'id' => 9,
                'page_id' => 5,
                'language_id' => 1,
                'title' => "WORKS",
                
            ],
            [
                'id' => 10,
                'page_id' => 5,
                'language_id' => 2,
                'title' => "WORKS",
                
            ],
            [
                'id' => 11,
                'page_id' => 6,
                'language_id' => 1,
                'title' => "NEWS",
                
            ],
            [
                'id' => 12,
                'page_id' => 6,
                'language_id' => 2,
                'title' => "NEWS",
                
            ],

        ];
        Page_transiation::insert($PageTransiations);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
