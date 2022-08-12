<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Config_detail_field;
use App\Models\Config_field;
use App\Models\Post;
use App\Models\Post_meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $getCategory = $this->getCategory();
        $post = Post::where('category_id', $getCategory->id)->get();


        return $this->renderView('layouts/posts/list', [
            'active' => 'list_post',
            'post' => $post,
            'getCategory' => $getCategory
        ]);
    }
    public function new()
    {
        $getCategory = $this->getCategory();
        $listField = Category_config_field::where('category_id', $getCategory->id)->pluck('config_field_id')->toArray();
        $listDetailField = Config_detail_field::whereIn('config_field_id', $listField)->whereIn('type',[1,2])->where('language_id',1)->get();
        $listDetailFieldImage = Config_detail_field::whereIn('config_field_id', $listField)->where('type',3)->where('language_id',1)->get();

        return $this->renderView('layouts/posts/new', [
            'active' => 'list_post',
            'getCategory' => $getCategory,
            'listDetailFieldLanguage' => $listDetailField,
            'listDetailFieldNotLanguage' => $listDetailFieldImage
        ]);
    }
    public function insert(Request  $request)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();
            
            $post = Post::create(
                ['category_id' => $data['category_id']]
            );
            
            foreach($request->allFiles() as $key => $file){
                $fileName = time() . "_" . $file->getClientOriginalName();
                Storage::putFileAs('public', $file, $fileName);
                Post_meta::create(
                    [
                        'post_id' => $post->id,
                        'language_id' => 1,
                        'meta_key' => $key,
                        'meta_value' => $fileName,
                    ]
                );
            }
           
            
            
            
            foreach($data['languages'] as  $language){
                foreach($language as $key =>$value){
                    $postMeta = Post_meta::create(
                        [
                            'post_id' => $post->id,
                            'language_id' => $language['languge_id'],
                            'meta_key' => $key,
                            'meta_value' => $value,
                        ]
                    );
                }
            }
            
            
           


            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return Redirect::back()->withInput($request->input())->with('error', $e->getMessage());
        }
        return Redirect::back()->with('success', 'Thêm thành công');
    }
}
