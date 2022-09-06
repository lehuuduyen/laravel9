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
        $postMeta = Post_meta::where('post_id',$postId);
        if($metaKey){
            $postMeta = $postMeta->where('meta_key',$metaKey);
        }
        $postMeta = $postMeta->pluck('meta_value')->first();
        return $postMeta;

    }
}
