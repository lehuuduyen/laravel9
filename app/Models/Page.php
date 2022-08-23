<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'page';
    protected $fillable = ['name','slug','status'];
    public $_ENGLISH = 1;
    public function getLanguageId(){
       
        $languageId = $this->_ENGLISH;
        if(!isset($_GET['language'])){
            $slug = \Session::get('website_language',config('app.locale'));
        }else{
            $slug = $_GET['language'];
        } 
        $language = Language::where('slug',$slug)->first();
        
        if($language){
            $languageId = $language->id;
        }
        return $languageId;
    }
    public function page_transiation()
    {
        $languageId = $this->getLanguageId();
        return $this->hasOne(Page_transiation::class,'page_id','id')->where('language_id',$languageId);
    }
    public function page_all_transiation()
    {
        return $this->hasMany(Page_transiation::class,'page_id','id');
    }
    public function page_config_field()
    {
        return $this->hasMany(Page_config_field::class,'page_id','id');
    }
   
}
