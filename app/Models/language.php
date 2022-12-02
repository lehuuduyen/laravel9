<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public static function ENGLISH_ID (){
        return 1;
    }
    public static function JAPAN_ID (){
        return 2;
    }  
}
