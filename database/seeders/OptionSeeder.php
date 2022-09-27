<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'id' => 1,
                'option_name' => "hamburger_top",
                'option_value' => "hamburger_top",
            ],
            [
                'id' => 2,
                'option_name' => "hamburger_foot",
                'option_value' => "hamburger_foot",
            ],
        ];
        Option::insert($options);
    }
}
