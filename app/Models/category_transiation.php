<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_transiation extends Model
{
    use HasFactory;
    protected $table = 'category_transiations';
    protected $fillable = ['category_id','language_id','title','sub_title','excerpt'];

}
