<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'page';
    protected $fillable = ['name', 'img_sp', 'img_pc', 'slug', 'status','is_category','banner_pc','banner_sp'];
    public $_ENGLISH = 1;
    public $_LIST_KEY_IMAGE = ['img_sp', 'img_pc','banner_pc','banner_sp'];
    
    public static function _STATUS_ACTIVE_MENU (){
        return 1;
    }
    public static function _STATUS_NO_ACTIVE_MENU (){
        return 2;
    }  
    public static function _STATUS_ACTIVE_MENU_ONLY_ONE_POST (){
        return 3;
    } 

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


    public static function formatJsonApi($slugPage,$listKeyPage=[],$listKeyPageTransiation=[],$listKeyPostMeta=[],$isCategory = false)
    {
        //banner top
        $languageId = getLanguageId();
        $temp =[];
        $page = Page::where('slug', $slugPage)->first();
        $pageModel = new Page();
        foreach($listKeyPageTransiation as $keyPageTransiation){
            $temp[$keyPageTransiation] =  ""; 
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
           
            
            foreach($listKeyPageTransiation as $keyPageTransiation){
                $temp[$keyPageTransiation] = (isset($page_transiations->$keyPageTransiation)) ? $page_transiations->$keyPageTransiation : ""; 
            }
            foreach($listKeyPage as $keyPage){
                
                $temp[$keyPage] = (in_array($keyPage,$pageModel->_LIST_KEY_IMAGE) && $page->$keyPage !="" )?env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($page->$keyPage):$page->$keyPage; 
            }
            //list post service
            $posts = Post::with('post_category')->where('page_id', $page->id)->get();
           
            
            
            foreach ($posts as $post) {
                if ($isCategory && empty($post['post_category'])  ){
                    continue;
                }
                $list['slug']= $post->slug;
              
                foreach($listKeyPostMeta as $keyPostMeta){
                    
                    $value = Post_meta::get_post_meta($post->id, $keyPostMeta);  
                  
                    $list[$keyPostMeta]= $value;
                }

                // $list['created_date']= date('Y-m-d H:i:s', strtotime($post->created_at));
                $list['updated_at']= date('Y-m-d H:i:s', strtotime($post->updated_at));
                
               
                
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
