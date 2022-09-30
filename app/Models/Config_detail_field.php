<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config_detail_field extends Model
{
    use HasFactory;
    protected $table = 'config_detail_field';
    protected $fillable = ['title','tags','key','type','config_field_id','language_id'];

    public static function typeText (){
        return 1;
    }
    public static function typeTextArea (){
        return 2;
    }  
    public static function typeImg (){
        return 3;
    } 
    public static function typeDescription (){
        return 4;
    } 
    public static function typeCheckBox (){
        return 5;
    } 
    public static function typeRadio (){
        return 6;
    } 
    public static function typeDropDown (){
        return 7;
    } 
    public function language()
    {
        return $this->hasOne(Language::class,'id','language_id');
    }

}
