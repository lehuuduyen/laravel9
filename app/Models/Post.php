<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = ['page_id','status','slug'];

    public function post_meta()
    {
        return $this->hasMany(Post_meta::class)->with('language');
    }
    
}
