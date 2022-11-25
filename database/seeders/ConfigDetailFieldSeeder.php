<?php

namespace Database\Seeders;

use App\Models\Config_detail_field;
use App\Models\Config_field;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigDetailFieldSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Config_detail_field = [
            [
                'id' => 1,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 2,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 3,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Image PC",
                'key' => "img_pc",
                'type' => 3,
            ],
            [
                'id' => 4,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Image SP",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 5,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Title jp",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 6,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Excerpt jp",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 7,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Image PC Jp",
                'key' => "img_pc",
                'type' => 3,
            ],

            [
                'id' => 8,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Image SP Jp",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 9,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Sub Title",
                'key' => "sub_title",
                'type' => 1,
            ],
            [
                'id' => 10,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Sub Title",
                'key' => "sub_title",
                'type' => 1,
            ],
            


            [
                'id' => 17,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Logo",
                'key' => "logo",
                'type' => 3,
            ],
            [
                'id' => 18,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Logo",
                'key' => "logo",
                'type' => 3,
            ],
            [
                'id' => 19,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Name",
                'key' => "name",
                'type' => 1,
            ],
            [
                'id' => 20,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Name",
                'key' => "name",
                'type' => 1,
            ],
            [
                'id' => 21,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Address",
                'key' => "address",
                'type' => 4,
            ],
            [
                'id' => 22,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Address",
                'key' => "address",
                'type' => 4,
            ],
            [
                'id' => 23,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Hotline",
                'key' => "hotline",
                'type' => 1,
            ],
            [
                'id' => 24,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Hotline",
                'key' => "hotline",
                'type' => 1,
            ],
            [
                'id' => 25,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Location",
                'key' => "location",
                'type' => 1,
            ],
            [
                'id' => 26,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Location",
                'key' => "location",
                'type' => 1,
            ],
            [
                'id' => 29,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Facebook",
                'key' => "facebook",
                'type' => 1,
            ],
            [
                'id' => 30,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Facebook",
                'key' => "facebook",
                'type' => 1,
            ],
            [
                'id' => 31,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Twitter",
                'key' => "twitter",
                'type' => 1,
            ],
            [
                'id' => 32,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Twitter",
                'key' => "twitter",
                'type' => 1,
            ],
            [
                'id' => 33,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Instagram",
                'key' => "instagram",
                'type' => 1,
            ],
            [
                'id' => 34,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Instagram",
                'key' => "instagram",
                'type' => 1,
            ],
            [
                'id' => 35,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Linkedin",
                'key' => "linkedin",
                'type' => 1,
            ],
            [
                'id' => 36,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Linkedin",
                'key' => "linkedin",
                'type' => 1,
            ],
            [
                'id' => 37,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Working Time",
                'key' => "working_time",
                'type' => 1,
            ],
            [
                'id' => 38,
                'config_field_id' => 2,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Working Time",
                'key' => "working_time",
                'type' => 1,
            ],
            [
                'id' => 39,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Vector Image",
                'key' => "img_vector",
                'type' => 3,
            ],
            [
                'id' => 40,
                'config_field_id' => 1,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Vector Image jp",
                'key' => "img_vector",
                'type' => 3,
            ],






            [
                'id' => 41,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],

            [
                'id' => 42,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],

            [
                'id' => 43,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Image PC",
                'key' => "img_pc",
                'type' => 3,
            ],

            [
                'id' => 44,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Image SP",
                'key' => "img_sp",
                'type' => 3,
            ],

            [
                'id' => 45,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Title jp",
                'key' => "title",
                'type' => 1,
            ],

            [
                'id' => 46,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Excerpt jp",
                'key' => "excerpt",
                'type' => 2,
            ],

            [
                'id' => 47,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Image PC Jp",
                'key' => "img_pc",
                'type' => 3,
            ],

            [
                'id' => 48,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Image SP Jp",
                'key' => "img_sp",
                'type' => 3,
            ],

            [
                'id' => 49,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Sub Title",
                'key' => "sub_title",
                'type' => 1,
            ],

            [
                'id' => 50,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Sub Title",
                'key' => "sub_title",
                'type' => 1,
            ],

           
            [
                'id' => 57,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Icon",
                'key' => "img",
                'type' => 3,
            ],

            [
                'id' => 58,
                'config_field_id' => 3,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Icon jp",
                'key' => "img",
                'type' => 3,
            ],

            //works
            [
                'id' => 59,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],

            [
                'id' => 60,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Title",
                'key' => "title",
                'type' => 1,
            ],
            [
                'id' => 61,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Sub title",
                'key' => "sub_title",
                'type' => 1,
            ],

            [
                'id' => 62,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Sub title",
                'key' => "sub_title",
                'type' => 1,
            ],
            [
                'id' => 63,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Image sp",
                'key' => "img_sp",
                'type' => 3,
            ],

            [
                'id' => 64,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Image sp",
                'key' => "img_sp",
                'type' => 3,
            ],
            [
                'id' => 65,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Image pc",
                'key' => "img_pc",
                'type' => 3,
            ],

            [
                'id' => 66,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Image pc",
                'key' => "img_pc",
                'type' => 3,
            ],

            [
                'id' => 67,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],

            [
                'id' => 68,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Excerpt",
                'key' => "excerpt",
                'type' => 2,
            ],
            [
                'id' => 71,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 1,
                'title' => "Thumbnail",
                'key' => "thumbnail",
                'type' => 3,
            ],

            [
                'id' => 72,
                'config_field_id' => 4,
                'tags'=>"",
                'language_id' => 2,
                'title' => "Thumbnail",
                'key' => "thumbnail",
                'type' => 3,
            ],
            [
                'id' => 73,
                'config_field_id' => 4,
                'language_id' => 1,
                'title' => "Technologies",
                'key' => "technologies",
                'tags'=> "After Effects,InDesign,Photoshop,HTML5,CSS3,JavaScript,Wordpress C#,JavaScript,SQL,PHP,Java,Zend Framework,AWS,nginx,Apache,Azure,oracle,spring など",
                'type' => 5,
            ],

            [
                'id' => 74,
                'config_field_id' => 4,
                'language_id' => 2,
                'title' => "Technologies",
                'key' => "technologies",
                'tags'=> "After Effects,InDesign,Photoshop,HTML5,CSS3,JavaScript,Wordpress C#,JavaScript,SQL,PHP,Java,Zend Framework,AWS,nginx,Apache,Azure,oracle,spring など",
                'type' => 5,
            ],

        

        ];
        Config_detail_field::insert($Config_detail_field);
        // \App\Models\Language::factory()->count(30)->create();

    }
}
