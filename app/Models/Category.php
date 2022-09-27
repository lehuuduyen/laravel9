<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['duration','price','name','slug','img_sp','img_pc','status','page_id','parent_id'];

    public function category_transiation()
    {
        return $this->hasMany(Category_transiation::class,'category_id','id');
        
                                    
    }
    public function category_child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    

    public static function getCategoryByPage($pageSlug){
        $data = DB::table('category')
            ->join('page', 'page.id', '=', 'category.page_id')
            ->where('page.slug',$pageSlug)
            ->select('category.*')
            ->get();
            return $data;
    }
   
}
