<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page_transiation extends Model
{
    use HasFactory;
    protected $table = 'page_transiations';
    protected $fillable = ['page_id','language_id','title','sub_title','excerpt'];

}
