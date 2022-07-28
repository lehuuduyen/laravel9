<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_config_field extends Model
{
    use HasFactory;
    protected $table = 'category_config_field';
    protected $fillable = ['category_id','config_field_id'];

}
