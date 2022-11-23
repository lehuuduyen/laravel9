<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_meta extends Model
{
    use HasFactory;
    protected $table = 'post_meta';
    protected $fillable = ['post_id', 'language_id', 'meta_key', 'meta_value', 'config_detail_field_id'];
    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
    public static function get_post_meta($postId, $metaKey = NULL)
    {
        $languageId = getLanguageId();

        if ($metaKey == "category") {
            $postCategory = Post_category::join('category_transiations', 'category_transiations.category_id', '=', 'post_category.category_id')->where('post_category.post_id', $postId)->where('category_transiations.language_id',$languageId)->get('category_transiations.title');
            
            
            $metaValue = [];
            foreach ($postCategory as $category) {
                $metaValue[] = $category['title'];
            }
        }else{
            $metaValue = "";
            $postMeta = Post_meta::join('config_detail_field', 'config_detail_field.id', '=', 'post_meta.config_detail_field_id')->where('post_meta.post_id', $postId)->where('post_meta.language_id', $languageId);
            if ($metaKey) {
                $postMeta = $postMeta->where('post_meta.meta_key', $metaKey);
            }
            $postMeta = $postMeta->select('config_detail_field.type', 'post_meta.meta_value')->first();
            if ($postMeta) {
                $metaValue = ($postMeta['type'] == Config_detail_field::typeImg() && $postMeta['meta_value'] != "") ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($postMeta['meta_value']) : $postMeta['meta_value'];
            }
        }
        

        return $metaValue;
    }
}
