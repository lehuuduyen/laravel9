<?php

namespace Database\Seeders;

use App\Models\Page_config_field;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageConfigFiledSeeder extends Seeder
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
            'page_id' => 3, //service
            'config_field_id' => 5,

        ],
        [
            'id' => 2,
            'page_id' => 5, //work
            'config_field_id' => 4,

        ],[
            'id' => 3,
            'page_id' => 6, //new
            'config_field_id' => 1,

        ],
        [
            'id' => 4,
            'page_id' => 4, //strength
            'config_field_id' => 3,

        ],
        [
            'id' => 5,
            'page_id' => 11, //infomation menu
            'config_field_id' => 2,

        ],[
            'id' => 6,
            'page_id' => 7, //resuit
            'config_field_id' => 1,

        ],
        [
            'id' => 7,
            'page_id' => 2, //company
            'config_field_id' => 6,

        ]
        
    ];
    Page_config_field::insert($page);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
