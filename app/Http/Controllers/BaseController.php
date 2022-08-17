<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class BaseController extends Controller
{
    public $_ENGLISH = 0;
    public function renderView($file, $param)
    {
        $listSlugCategory = [];
        $category = Category::with('category_transiation')->get();
        
        
        
        $param['category'] = $category;
        foreach ($param['category'] as $key => $val) {
            $param['category'][$key]['title'] = $val['category_transiation'][$this->_ENGLISH]->title; 
            $param['category'][$key]['sub_title'] = $val['category_transiation'][$this->_ENGLISH]->sub_title; 
            $param['category'][$key]['excerpt'] = $val['category_transiation'][$this->_ENGLISH]->excerpt; 
            $listSlugCategory[] = $val->slug;
        }
        if (in_array(Request::path(), $listSlugCategory)) {
            $param['active'] = Request::path();
            $param['activeCategory'] = true;
        }

        //list language
        $allLanguage = Language::get();
        $param['allLanguage'] = $allLanguage;
        return view($file, $param);
    }
    public function storeImage($request) {
        $path = $request->storeAs('public/profile',"abc.png");
        return substr($path, strlen('public/'));
    }
    public function getCategory(){
        $slug = explode("/", Request::path())[0];
        $getCategory = Category::where('slug', $slug)->first();
        if($getCategory){
            return $getCategory;
        }
        return $this->error("Empty","Category not exists");
    }

    public function error($title,$content)
    {
        # code...
        $data['title'] = $title;
        $data['name'] = $content;
        return response()->view('errors.404',$data,404);
    }

    public function getPostByConfig($id)
    {
        # code...
        $listCategory = Category_config_field::where('config_field_id',$id)->pluck('category_id');
        $listPost = Post::whereIn('category_id',$listCategory)->pluck('id');
        return $listPost;
    }
    public function getPostByCategory($id)
    {
        # code...
        $listPost = Post::where('category_id',$id)->pluck('id');
        return $listPost;
    }
    public function returnJson($data,$message ='',$status=true,$code=Response::HTTP_OK)
    {
          return response()->json(
            [
                'success'=>$status,
                'data'=>$data,
                'message'=>$message
            ], $code);
    }
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
