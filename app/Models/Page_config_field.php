<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page_config_field extends Model
{
    use HasFactory;
    protected $table = 'page_config_field';
    protected $fillable = ['page_id','config_field_id'];

}
