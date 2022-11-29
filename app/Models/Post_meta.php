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
    public static function getPostCategory($postId){
        
        
        
        $languageId = getLanguageId();
        $postCategory = Post_category::join('category', 'category.id', '=', 'post_category.category_id')->join('category_transiations', 'category_transiations.category_id', '=', 'post_category.category_id')->where('post_category.post_id', $postId)->where('category_transiations.language_id',$languageId)->get(['category_transiations.title','category.slug']);
        $metaValue = [];
        
        foreach ($postCategory as $category) {
            $temp['slug'] = $category['slug'];
            $temp['title'] = $category['title'];
            $metaValue[] = $temp;
        }
        return $metaValue;
    }
    public static function get_post_meta($postId, $metaKey = NULL)
    {
        $languageId = getLanguageId();
        $metaValue = [];

       
        
        if ($metaKey == "category") {
            $metaValue = Post_meta::getPostCategory($postId);
        }else{
            
            $postMeta = Post_meta::join('config_detail_field', 'config_detail_field.id', '=', 'post_meta.config_detail_field_id')->where('post_meta.post_id', $postId)->where('post_meta.language_id', $languageId);
            if ($metaKey == NULL) {
                $postMeta = $postMeta->select('config_detail_field.type', 'post_meta.meta_value', 'post_meta.meta_key')->get();
                foreach($postMeta as $value){
                    $metaValue[$value['meta_key']] =($value['type'] == Config_detail_field::typeImg() && $value['meta_value'] != "") ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($value['meta_value']) : $value['meta_value'];
                    
                }                
            }else{
                $metaValue = "";
                $postMeta = $postMeta->where('post_meta.meta_key', $metaKey);
                $postMeta = $postMeta->select('config_detail_field.type', 'post_meta.meta_value')->first();
                if ($postMeta) {
                    $metaValue = ($postMeta['type'] == Config_detail_field::typeImg() && $postMeta['meta_value'] != "") ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($postMeta['meta_value']) : $postMeta['meta_value'];
                }
            }
            
           
        }
        

        return $metaValue;
    }
    public static function get_post_meta_title($postId, $metaKey = NULL)
    {
        $languageId = getLanguageId();
        
        $metaValue = [];
            
            $postMeta = Post_meta::join('config_detail_field', 'config_detail_field.id', '=', 'post_meta.config_detail_field_id')->where('post_meta.post_id', $postId)->where('post_meta.language_id', $languageId);
            if ($metaKey == NULL) {
                $postMeta = $postMeta->select('config_detail_field.type', 'post_meta.meta_value', 'post_meta.meta_key')->get();
                foreach($postMeta as $value){
                    $metaValue = [];
                    $metaValue['title'] = $value['config_detail_field']['title'];
                    $metaValue['value'] =($value['type'] == Config_detail_field::typeImg() && $value['meta_value'] != "") ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($value['meta_value']) : $value['meta_value'];
                    
                }                
            }else{
                $metaValue = [];
                $postMeta = $postMeta->where('post_meta.meta_key', $metaKey);
                $postMeta = $postMeta->select('config_detail_field.type','config_detail_field.title', 'post_meta.meta_value')->first();
                if ($postMeta) {
                    $metaValue['title'] = $postMeta['title'];
                    $metaValue['value'] = ($postMeta['type'] == Config_detail_field::typeImg() && $postMeta['meta_value'] != "") ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($postMeta['meta_value']) : $postMeta['meta_value'];
                }
            }
            
           
        

        return $metaValue;
    }
}
