<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_category extends Model
{
    use HasFactory;
    protected $table = 'post_category';
    protected $fillable = ['post_id','category_id'];
   
}
