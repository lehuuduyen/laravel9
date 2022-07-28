<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request as FormRequest;
use Illuminate\Support\Facades\Request;

class PostController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slug = Request::path();
        $getCategory =Category::where('slug', $slug)->first();
        $post = Post::where('category_id', $getCategory->id)->get();
       
        
        return $this->renderView('layouts/posts/list',[
            'active'=>'list_post',
            'post'=>$post,
            'getCategory' => $getCategory
        ]);
    }
    public function new()
    {
        $slug = Request::path();
        $getCategory =Category::where('slug', $slug)->first();
        return $this->renderView('layouts/posts/new',['active'=>'list_post',
        'getCategory' => $getCategory]);
    }
}
