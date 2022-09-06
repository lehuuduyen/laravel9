<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'page';
    protected $fillable = ['name', 'img_sp', 'img_pc', 'slug', 'status'];
    public $_ENGLISH = 1;
    public function getLanguageId()
    {

        $languageId = $this->_ENGLISH;
        if (!isset($_GET['language'])) {
            $slug = \Session::get('website_language', config('app.locale'));
        } else {
            $slug = $_GET['language'];
        }
        $language = Language::where('slug', $slug)->first();

        if ($language) {
            $languageId = $language->id;
        }
        return $languageId;
    }
    public function page_transiation()
    {
        $languageId = $this->getLanguageId();
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
        $PageModel = new Page();
        $languageId = $PageModel->getLanguageId();
        
        $page = Page::where('slug', $slugPage)->first();
        foreach($listKeyPageTransiation as $keyPageTransiatio){
            $temp[$keyPageTransiatio] =  ""; 
        }
        foreach($listKeyPage as $keyPage){
            $temp[$keyPage] = ""; 
        }
        if(count($listKeyPostMeta)>0){
            $temp['list']=[];
        }
        if ($page) {
            $page_transiations = Page_transiation::where("language_id", $languageId)->where('page_id', $page->id)->first();

            $title = (isset($page_transiations->title)) ? $page_transiations->title : "";
            $excerpt = (isset($page_transiations->excerpt)) ? $page_transiations->excerpt : "";
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

                $temp['list'][] =$list;
            }

        }
        return $temp;

    }
}
