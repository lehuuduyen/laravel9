<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_meta extends Model
{
    use HasFactory;
    protected $table = 'post_meta';
    protected $fillable = ['post_id','language_id','meta_key','meta_value','config_detail_field_id'];
    public function language()
    {
        return $this->hasOne(Language::class,'id','language_id');
    }
    public static function get_post_meta($postId,$metaKey=NULL){
        $metaValue = "";
        $languageId = getLanguageId();
        $postMeta = Post_meta::join('config_detail_field', 'config_detail_field.id', '=', 'post_meta.config_detail_field_id')->where('post_meta.post_id',$postId)->where('post_meta.language_id',$languageId);
        if($metaKey){
            $postMeta = $postMeta->where('post_meta.meta_key',$metaKey);
        }
        $postMeta = $postMeta->select('config_detail_field.type','post_meta.meta_value')->first();
        
        if($postMeta){
            $metaValue = ($postMeta['type'] == Config_detail_field::typeImg() && $postMeta['meta_value'] !="" ) ? env('APP_URL','http://localhost:8080').\Storage::disk(config('juzaweb.filemanager.disk'))->url($postMeta['meta_value']):$postMeta['meta_value'];
        }
        
        return $metaValue;

    }
}
