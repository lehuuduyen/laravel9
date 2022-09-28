<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'page';
    protected $fillable = ['name', 'img_sp', 'img_pc', 'slug', 'status','is_category'];
    public $_ENGLISH = 1;
    
    public function page_transiation()
    {
        $languageId = getLanguageId();
        return $this->hasOne(Page_transiation::class, 'page_id', 'id')->where('language_id', $languageId);
    }
    public function page_all_transiation()
    {
        return $this->hasMany(Page_transiation::class, 'page_id', 'id');
    }
    public function page_config_field()
    {
        return $this->hasMany(Page_config_field::class, 'page_id', 'id');
    }


    public static function formatJsonApi($slugPage,$listKeyPage=[],$listKeyPageTransiation=[],$listKeyPostMeta=[])
    {
        //banner top
        $languageId = getLanguageId();
        $temp =[];
        $page = Page::where('slug', $slugPage)->first();
        foreach($listKeyPageTransiation as $keyPageTransiatio){
            $temp[$keyPageTransiatio] =  ""; 
        }
        foreach($listKeyPage as $keyPage){
            $temp[$keyPage] = ""; 
        }
        if(count($listKeyPage) > 0 || count($listKeyPageTransiation) > 0){
            if(count($listKeyPostMeta)>0 ){
                $temp['list']=[];
            }
        }
       
        
        if ($page) {
            $page_transiations = Page_transiation::where("language_id", $languageId)->where('page_id', $page->id)->first();
            foreach($listKeyPageTransiation as $keyPageTransiatio){
                $temp[$keyPageTransiatio] = (isset($page_transiations->$keyPageTransiatio)) ? $page_transiations->$keyPageTransiatio : ""; 
            }
            foreach($listKeyPage as $keyPage){
                $temp[$keyPage] = $page->$keyPage; 
            }
            //list post service
            $posts = Post::where('page_id', $page->id)->get();
            foreach ($posts as $post) {
                foreach($listKeyPostMeta as $keyPostMeta){
                    $value = Post_meta::get_post_meta($post->id, $keyPostMeta);  
                    $list[$keyPostMeta]= $value;
                }
                $list['created_date']= date('Y-m-d H:i:s', strtotime($post->created_at));
                $list['updated_date']= date('Y-m-d H:i:s', strtotime($post->updated_at));
                $list['slug']= $post->slug;
               
                
                if(count($listKeyPage) == 0 && count($listKeyPageTransiation) == 0){
                    $temp[] = $list;
                }else{
                    $temp['list'][] =$list;
                }
            }

        }
        return $temp;

    }
}
