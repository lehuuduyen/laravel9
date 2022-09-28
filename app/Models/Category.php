<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['duration', 'price', 'name', 'slug', 'img_sp', 'img_pc', 'status', 'page_id', 'parent_id'];
    public static function CATEGORY_ACTIVE()
    {
        return 1;
    }
    public static function CATEGORY_UN_ACTIVE()
    {
        return 2;
    }
    public function category_transiation_by_language()
    {
        $languageId = getLanguageId();
        return $this->hasOne(Category_transiation::class, 'category_id', 'id')->where('language_id', $languageId);
    }
    public function category_transiation()
    {
        return $this->hasMany(Category_transiation::class, 'category_id', 'id');
    }
    public function category_child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public static function getPostByCategory($categoryId,$listKeyPostMeta=[])
    {
         //list post service
        $data =[];
        $posts = Post::join('post_category', 'post_category.post_id', '=', "post.id")->select('post.*')->where('post_category.category_id',$categoryId)->get();
        
        foreach ($posts as $post) {
            foreach($listKeyPostMeta as $keyPostMeta){
                $value = Post_meta::get_post_meta($post->id, $keyPostMeta);  
                $list[$keyPostMeta]= $value;
            }
            $list['created_date']= date('Y-m-d H:i:s', strtotime($post->created_at));
            $list['updated_date']= date('Y-m-d H:i:s', strtotime($post->updated_at));
            $list['slug']= $post->slug;
            array_push($data,$list);
        }
        return $data;
    }
    public static function getCategoryByPage($pageSlug)
    {
        $data = DB::table('category')
            ->join('page', 'page.id', '=', 'category.page_id')
            ->where('page.slug', $pageSlug)
            ->select('category.*')
            ->get();
        return $data;
    }
}
