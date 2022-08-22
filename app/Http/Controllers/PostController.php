<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page_config_field;
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
    public $_SLUG = "";
    public $_DEFAULT_LANGUAGE = 1;
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
            'postActive' => true,
            'active' => $_GET['post_type'],
            'post' => $post,
            'getCategory' => $getCategory
        ]);
    }
    public function create()
    {
        $getCategory = $this->getCategory();
        $listField = Page_config_field::where('category_id', $getCategory->id)->pluck('config_field_id')->toArray();
        $listDetailFieldLanguage = Config_detail_field::whereIn('config_field_id', $listField)->whereIn('type', [1, 2])->where('language_id', $this->_DEFAULT_LANGUAGE)->get();
        $listDetailFieldNotLanguage = Config_detail_field::whereIn('config_field_id', $listField)->where('type', 3)->where('language_id', $this->_DEFAULT_LANGUAGE)->get();
        
        return $this->renderView('layouts/posts/new', [
            'postActive' => true,
            'active' => $_GET['post_type'],
            'getCategory' => $getCategory,
            'listDetailFieldLanguage' => $listDetailFieldLanguage,
            'listDetailFieldNotLanguage' => $listDetailFieldNotLanguage
        ]);
    }
    public function edit($id)
    {
        $getCategory = $this->getCategory();
        $listField = Page_config_field::where('category_id', $getCategory->id)->pluck('config_field_id')->toArray();
        $listDetailField = Config_detail_field::whereIn('config_field_id', $listField)->where('language_id', $this->_DEFAULT_LANGUAGE)->get();
        $postDetail = Post::with('post_meta')->find($id);
        foreach ($listDetailField as $key => $detailField) {
            $listDetailField[$key]['value'] = "";
            foreach ($postDetail->post_meta as $keyPostMeta => $postMeta) {
                if ($postMeta['config_detail_field_id'] == $detailField['id']) {
                    //title and text area
                    if ($detailField['type'] == 1 || $detailField['type'] == 2) {
                        $listDetailField[$key][$postMeta->language['slug']] = $postMeta['meta_value'];
                    }
                    //image
                    if ($detailField['type'] == 3) {
                        $listDetailField[$key]['value'] = $postMeta['meta_value'];
                    }
                    unset($postDetail->post_meta[$keyPostMeta]);
                }
            }
            if ($detailField['type'] == 1 || $detailField['type'] == 2) {
                $listDetailFieldLanguage[] = $listDetailField[$key];
            }
            if ($detailField['type'] == 3) {
                if ($listDetailField[$key]['value'] != "") {
                    $listDetailField[$key]['value'] = '/storage/' . $listDetailField[$key]['value'];
                }
                $listDetailFieldNotLanguage[] = $listDetailField[$key];
            }
        }



        return $this->renderView('layouts/posts/new', [
            'postActive' => true,
            'active' => $_GET['post_type'],
            'getCategory' => $getCategory,
            'listDetailFieldLanguage' => $listDetailFieldLanguage,
            'listDetailFieldNotLanguage' => $listDetailFieldNotLanguage,
            'postDetail' => $postDetail
        ]);
    }
    public function store(Request  $request)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();


            if ($data['slug'] == null) {
                $this->_SLUG = $data['slug'] = $data['post_type'];
            }

            // check slug
            $slug = $this->isSlugPost($data['slug']);
            $slug = $this->_SLUG;

            $post = Post::create(
                ['category_id' => $data['category_id'], 'slug' => $slug]
            );


            if (isset($request->allFiles()['image'])) {
                foreach ($request->allFiles()['image'] as $configDetailId => $files) {

                    foreach ($files as $key => $file)

                        $fileName = time() . "_" . $file->getClientOriginalName();

                    Storage::putFileAs('public', $file, $fileName);
                    Post_meta::create(
                        [
                            'post_id' => $post->id,
                            'config_detail_field_id' => $configDetailId,
                            'language_id' => 1,
                            'meta_key' => $key,
                            'meta_value' => $fileName,
                        ]
                    );
                }
            }

            foreach ($data['languages'] as $configDetailId =>  $language) {
                foreach ($language as $languge_id => $value) {

                    $postMeta = Post_meta::create(
                        [
                            'post_id' => $post->id,
                            'config_detail_field_id' => $configDetailId,
                            'language_id' => $languge_id,
                            'meta_key' => key($value),
                            'meta_value' => $value[key($value)],
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
    public function update(Request  $request, $id)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();



            if ($data['slug'] == null) {
                $this->_SLUG = $data['slug'] = $data['post_type'];
            }

            // check slug
            $slug = $this->isSlugPost($data['slug']);
            $slug = $this->_SLUG;
            // update post
            $post = Post::find($id)->update(
                ['slug' => $slug]
            );
            //xóa tất cả post meta type khác hình
            DB::table('post_meta')->join('config_detail_field', 'config_detail_field.id', '=', 'post_meta.config_detail_field_id')
                ->where('config_detail_field.type', '!=', Config_detail_field::typeImg())->where('post_meta.post_id', $id)->delete();


            //xóa tất cả file hình rồi thêm lại



            if (isset($request->allFiles()['image'])) {
                // Storage::delete('public/'.$link['value']);
                //xóa tất cả post meta type  hình 
                foreach ($request->allFiles()['image'] as $configDetailId => $files) {

                    foreach ($files as $key => $file) {
                        $fileName = time() . "_" . $file->getClientOriginalName();

                        Storage::putFileAs('public', $file, $fileName);
                        $getMeta = Post_meta::where('post_id', $id)->where('config_detail_field_id', $configDetailId)->where('meta_key', $key)->first();
                        if ($getMeta) {
                            Storage::delete('public/' . $getMeta->meta_value);
                            Post_meta::where('post_id', $id)->where('config_detail_field_id', $configDetailId)->where('meta_key', $key)->update(
                                [
                                    'meta_value' => $fileName,
                                ]
                            );
                        } else {
                            Post_meta::create(
                                [
                                    'post_id' => $id,
                                    'config_detail_field_id' => $configDetailId,
                                    'language_id' => 1,
                                    'meta_key' => $key,
                                    'meta_value' => $fileName,
                                ]
                            );
                        }
                    }
                }
            }


            foreach ($data['languages'] as $configDetailId =>  $language) {
                foreach ($language as $languge_id => $value) {

                    $postMeta = Post_meta::create(
                        [
                            'post_id' => $id,
                            'config_detail_field_id' => $configDetailId,
                            'language_id' => $languge_id,
                            'meta_key' => key($value),
                            'meta_value' => $value[key($value)],
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
        return Redirect::back()->with('success', 'Update thành công');
    }
    public function isSlugPost($slug)
    {

        $post = Post::where('slug', $slug)->first();


        if ($post) {

            $this->isSlugPost($slug . "-2");
        } else {
            $this->_SLUG = $slug;
            return $slug;
        }
    }
}
