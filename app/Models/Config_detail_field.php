<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config_detail_field extends Model
{
    use HasFactory;
    protected $table = 'config_detail_field';
    protected $fillable = ['title','key','type','config_field_id'];

    public static function typeText (){
        return 1;
    }
    public static function typeTextArea (){
        return 2;
    }  
    public static function typeImg (){
        return 3;
    } 
    

}
