<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Category_transiation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTransiationsSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryTransiation = [
            [
            'id' => 1,
            'category_id' => 1,
            'language_id' => 1,
            'title' => "ICD Vietnam for offshore development in Vietnam",
            'sub_title' => "",
            'excerpt' => "ICD's Japanese staff stationed in Vietnam will manage the project to solve the quality and communication issues of the product and provide smooth and high-quality offshore development.",
        ],
        [
            'id' => 2,
            'category_id' => 1,
            'language_id' => 2,
            'title' => "ベトナムのオフショア開発ならICD Vietnam",
            'sub_title' => "",
            'excerpt' => "ベトナム現地に駐在しているICDの日本人スタッフがプロジェクトをマネージメントすることにより、制作物の品質やコミュニケーションへの課題を解決し、スムーズで高品質なオフショア開発を提供します。",
        ],

        [
            'id' => 3,
            'category_id' => 2,
            'language_id' => 1,
            'title' => "ABOUT US",
            'sub_title' => "About ICD Vietnam",
            'excerpt' => "ICD Vietnam provides speedy and high-quality services by utilizing the know-how of software development and web system development cultivated in Japan.
            ICD Vietnam's offshore development establishes a business flow that combines the good points of Japan and Vietnam by hiring excellent human resources who understand Japanese customs and have Japanese staff stationed. There is no difference in quality with Japan.",
        ],
        [
            'id' => 4,
            'category_id' => 2,
            'language_id' => 2,
            'title' => "ABOUT US",
            'sub_title' => "ICD Vietnam について",
            'excerpt' => "ICD Vietnam は、日本で培ってきたソフトウェア開発・Webシステム開発のノウハウを活かし、スピーディーで高品質なサービスを提供しています。
            ICD Vietnam のオフショア開発は、日本スタッフが常駐し、日本の慣習を理解した優秀な人材を採用することで、日本とベトナムの良い点を兼ね備えた業務フローを確立。日本との品質の格差はありません。
            
            ",
        ],
        [
            'id' => 5,
            'category_id' => 3,
            'language_id' => 1,
            'title' => "SERVICES",
            'sub_title' => "Service",
            'excerpt' => "We provide services such as offshore development, web production, system/application development, and video production.",
        ],
        [
            'id' => 6,
            'category_id' => 3,
            'language_id' => 2,
            'title' => "SERVICES",
            'sub_title' => "サービス",
            'excerpt' => "オフショア開発、Web制作、システム・アプリ開発、動画制作などのサービスをご提供します。",
        ],
        [
            'id' => 7,
            'category_id' => 4,
            'language_id' => 1,
            'title' => "STRENGTHS",
            'sub_title' => "Strengths of ICD Vietnam",
            'excerpt' => "",
        ],
        [
            'id' => 8,
            'category_id' => 4,
            'language_id' => 2,
            'title' => "STRENGTHS",
            'sub_title' => "ICD Vietnam の強み",
            'excerpt' => "",
        ],
        [
            'id' => 9,
            'category_id' => 5,
            'language_id' => 1,
            'title' => "WORKS",
            'sub_title' => "Production record",
            'excerpt' => "",
        ],
        [
            'id' => 10,
            'category_id' => 5,
            'language_id' => 2,
            'title' => "WORKS",
            'sub_title' => "制作実績",
            'excerpt' => "",
        ],
        [
            'id' => 11,
            'category_id' => 6,
            'language_id' => 1,
            'title' => "NEWS",
            'sub_title' => "News",
            'excerpt' => "",
        ],
        [
            'id' => 12,
            'category_id' => 6,
            'language_id' => 2,
            'title' => "NEWS",
            'sub_title' => "ニュース",
            'excerpt' => "",
        ],
    
    ];
        Category_transiation::insert($categoryTransiation);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
