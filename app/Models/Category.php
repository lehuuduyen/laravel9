<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['name','slug','img_sp','img_pc'];

    public function category_transiation()
    {
        return $this->hasMany(Category_transiation::class,'category_id','id');
    }
    public function category_config_field()
    {
        return $this->hasMany(Category_config_field::class,'category_id','id');
    }
   
}
