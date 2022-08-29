<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Language;
use App\Models\Page;
use App\Models\Page_config_field;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class BaseController extends Controller
{
 
    public function renderView($file, $param)
    {
       
        
        
        $listSlugCategory = [];
        $page = Page::with('page_transiation')->where('status',1)->get();
        
        
        $param['page'] = $page;
        foreach ($param['page'] as $key => $val) {
        
            $param['page'][$key]['title'] = $val['page_transiation']->title; 
            $listSlugCategory[] = $val->slug;
        }
        if (in_array(Request::path(), $listSlugCategory)) {
            $param['active'] = Request::path();
            $param['activePage'] = true;
        }

        //list language
        $allLanguage = Language::get();
        $param['allLanguage'] = $allLanguage;
        $param['slugLanguage'] = \Session::get('website_language',config('app.locale'));
        $param['admin_prefix'] = config('app.admin_prefix');
        
        return view($file, $param);
    }
    public function storeImage($request) {
        $path = $request->storeAs('public/profile',"abc.png");
        return substr($path, strlen('public/'));
    }
    public function getPage(){
        if(isset($_GET['post_type'])){
            $slug = $_GET['post_type'];
            $getPage = Page::where('slug', $slug)->where('status',1)->first();
            if($getPage){
                return $getPage;
            }
        }
        return $this->error("Empty","Page not exists");
        
    }

    public function error($title,$content)
    {
        # code...
        $data['title'] = $title;
        $data['name'] = $content;
        abort(404);
    }

    public function getPageByConfig($id)
    {
        # code...
        $listPage = Page_config_field::where('config_field_id',$id)->pluck('page_id');
        return $listPage;
    }
    public function getPostByPage($id)
    {
        # code...
        $listPost = Post::where('page_id',$id)->pluck('id');
        return $listPost;
    }
    public function getPostByCategory($id)
    {
        # code...
        $listPost = Post::where('page_id',$id)->pluck('id');
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
