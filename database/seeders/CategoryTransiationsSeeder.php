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
           
    ];
        Category_transiation::insert($categoryTransiation);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
