<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page_config_field;
use App\Models\Config_detail_field;
use App\Models\Config_field;
use App\Models\Language;
use App\Models\Page;
use App\Models\Post;
use App\Models\Post_category;
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
        $getPage = $this->getPage();



        return $this->renderView('layouts/posts/list', [
            'postActive' => "index",
            'activeUL' => $_GET['post_type'],
            'active' => $_GET['post_type'],
            'getPage' => $getPage
        ]);
    }
    public function create()
    {

        $getPage = $this->getPage();

        $listPost = Post::where('page_id', $getPage['id'])->first();

        if ($listPost && $getPage['status'] == Page::_STATUS_ACTIVE_MENU_ONLY_ONE_POST()) {
            return redirect("/post/" . $listPost['id'] . "/edit?post_type=" . $getPage['slug'])->with('success', 'Thêm thành công');
        }
        $getAllCategory = $this->getAllCategory();
        $htmlRecursiveCategory = $this->htmlRecursiveCategory($getAllCategory);

        $listField = Page_config_field::where('page_id', $getPage->id)->pluck('config_field_id')->toArray();
        $listDetailFieldLanguage = Config_detail_field::whereIn('config_field_id', $listField)->whereIn('type', [1, 2, 4])->where('language_id', getLanguageId())->get();
        $listDetailFieldNotLanguage = Config_detail_field::whereIn('config_field_id', $listField)->whereIn('type', [3, 5, 6, 7])->where('language_id', getLanguageId())->get();

        return $this->renderView('layouts/posts/new', [
            'postActive' => "create",
            'activeUL' => $_GET['post_type'],
            'active' => $_GET['post_type'],
            'htmlRecursiveCategory' => $htmlRecursiveCategory,
            'listDetailFieldLanguage' => $listDetailFieldLanguage,
            'listDetailFieldNotLanguage' => $listDetailFieldNotLanguage,
            'getPage' => $getPage

        ]);
    }
    public function edit($id)
    {
        $pageModel = new Page();
        $listDetailFieldLanguage = [];
        $listDetailFieldNotLanguage = [];

        $getPage = $this->getPage();
        
        $listField = Page_config_field::where('page_id', $getPage->id)->pluck('config_field_id')->toArray();
        $listDetailField = Config_detail_field::whereIn('config_field_id', $listField)->where('language_id', getLanguageId())->get();
        $postDetail = Post::with('post_meta')->find($id);
        if(!$postDetail){
            return $this->error("Empty", "Page not exists");
        }
        $getAllCategory = $this->getAllCategory();
        $getCategoryByPost = Post_category::where('post_id', $id)->pluck('category_id')->toArray();

        $htmlRecursiveCategory = $this->htmlRecursiveCategory($getAllCategory, $getCategoryByPost);
        foreach ($listDetailField as $key => $detailField) {
            $listDetailField[$key]['value'] = "";
            foreach ($postDetail->post_meta as $keyPostMeta => $postMeta) {
                if ($postMeta['config_detail_field_id'] == $detailField['id']) {
                    //title and text area
                    if ($detailField['type'] == Config_detail_field::typeText() || $detailField['type'] == Config_detail_field::typeTextArea() || $detailField['type'] == Config_detail_field::typeDescription()) {
                        $listDetailField[$key][$postMeta->language['slug']] = $postMeta['meta_value'];
                    }
                    //image
                    if ($detailField['type'] == Config_detail_field::typeImg() || $detailField['type'] == Config_detail_field::typeCheckBox() || $detailField['type'] == Config_detail_field::typeRadio() || $detailField['type'] == Config_detail_field::typeDropDown()) {
                        $listDetailField[$key]['value'] = $postMeta['meta_value'];
                    }
                    unset($postDetail->post_meta[$keyPostMeta]);
                }
            }
            if ($detailField['type'] == Config_detail_field::typeText() || $detailField['type'] == Config_detail_field::typeTextArea() || $detailField['type'] == Config_detail_field::typeDescription()) {
                $listDetailFieldLanguage[] = $listDetailField[$key];
            }
            if ($detailField['type'] == Config_detail_field::typeImg() || $detailField['type'] == Config_detail_field::typeCheckBox() || $detailField['type'] == Config_detail_field::typeRadio() || $detailField['type'] == Config_detail_field::typeDropDown()) {
                if ($listDetailField[$key]['value'] != "") {
                    $listDetailField[$key]['value'] =  $listDetailField[$key]['value'];
                }
                $listDetailFieldNotLanguage[] = $listDetailField[$key];
            }
        }


        return $this->renderView('layouts/posts/new', [
            'postActive' => "create",
            'activeUL' => $_GET['post_type'],
            'active' => $_GET['post_type'],
            'listDetailFieldLanguage' => $listDetailFieldLanguage,
            'listDetailFieldNotLanguage' => $listDetailFieldNotLanguage,
            'postDetail' => $postDetail,
            'getPage' => $getPage,
            'htmlRecursiveCategory' => $htmlRecursiveCategory,

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
            $getPage = $this->getPage();
            $post = Post::create(
                ['slug' => $slug, 'page_id' => $getPage->id]
            );
            $postId = $post->id;
            $getAllLangugae = Language::pluck('id')->toArray();
       
            

            //image
            if (isset($request['image'])) {
                foreach ($request['image'] as $configDetailId => $files) {
                    foreach ($files as $key => $file) {
                        foreach($getAllLangugae as $languageId){
                            Post_meta::create(
                                [
                                    'post_id' => $postId,
                                    'config_detail_field_id' => $configDetailId,
                                    'language_id' => $languageId,
                                    'meta_key' => $key,
                                    'meta_value' => $file,
                                ]
                            );
                        }
                       
                    }
                }
            }
            //language
            if (isset($data['languages'])) {
                foreach ($data['languages'] as $configDetailId =>  $language) {
                    foreach ($language as $languge_id => $value) {

                        $postMeta = Post_meta::create(
                            [
                                'post_id' => $postId,
                                'config_detail_field_id' => $configDetailId,
                                'language_id' => $languge_id,
                                'meta_key' => key($value),
                                'meta_value' => $value[key($value)],
                            ]
                        );
                    }
                }
            }

            //category
            //them category
            if (isset($data['categories'])) {
                foreach ($data['categories'] as $category) {
                    $postCategory = Post_category::create(
                        [
                            'post_id' => $postId,
                            'category_id' => $category,
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
        return redirect("/post/$postId/edit?post_type=" . $getPage['slug'])->with('success', 'Thêm thành công');
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
            $slug = $this->isSlugPost($data['slug'], $id);
            $slug = $this->_SLUG;
            // update post
            Post::find($id)->update(
                ['slug' => $slug]
            );
            //xóa tất cả post meta type ko là hình
            DB::table('post_meta')->join('config_detail_field', 'config_detail_field.id', '=', 'post_meta.config_detail_field_id')
                ->where('config_detail_field.type', '!=', Config_detail_field::typeImg())->where('post_meta.post_id', $id)->delete();
            //xóa tất cả file hình rồi thêm lại
            $getAllLangugae = Language::pluck('id')->toArray();
            if (isset($request['image'])) {
                foreach ($request['image'] as $configDetailId => $files) {
                    foreach ($files as $key => $file) {
                        foreach($getAllLangugae as $languageId){
                            Post_meta::create(
                                [
                                    'post_id' => $id,
                                    'config_detail_field_id' => $configDetailId,
                                    'language_id' => $languageId,
                                    'meta_key' => $key,
                                    'meta_value' => $file,
                                ]
                            );
                        }
                    }
                }
            }

            if (isset($data['languages'])) {
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
            }

            if (isset($data['radio'])) {
                foreach ($data['radio'] as $configDetailId =>  $radio) {
                    foreach ($radio as $key => $value) {
                        $postMeta = Post_meta::create(
                            [
                                'post_id' => $id,
                                'config_detail_field_id' => $configDetailId,
                                'language_id' => 1,
                                'meta_key' => $key,
                                'meta_value' => $value,
                            ]
                        );
                    }
                }
            }
            if (isset($data['dropdown'])) {
                foreach ($data['dropdown'] as $configDetailId =>  $dropdown) {
                    foreach ($dropdown as $value) {
                        $postMeta = Post_meta::create(
                            [
                                'post_id' => $id,
                                'config_detail_field_id' => $configDetailId,
                                'language_id' => 1,
                                'meta_key' => $key,
                                'meta_value' => $value,
                            ]
                        );
                    }
                }
            }
            if (isset($data['checkbox'])) {
                foreach ($data['checkbox'] as $configDetailId =>  $checkbox) {
                    foreach ($checkbox as $value) {



                        $postMeta = Post_meta::create(
                            [
                                'post_id' => $id,
                                'config_detail_field_id' => $configDetailId,
                                'language_id' => 1,
                                'meta_key' => key($value),
                                'meta_value' => json_encode($value),
                            ]
                        );
                    }
                }
            }
            //category
            // delete category
            DB::table('post_category')->where('post_id', $id)->delete();
            //them category
            if (isset($data['categories'])) {

                foreach ($data['categories'] as $categoryId) {
                    $postCategory = Post_category::create(
                        [
                            'post_id' => $id,
                            'category_id' => $categoryId,
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
    public function isSlugPost($slug, $postId = "")
    {

        $post = Post::where('slug', $slug)->first();


        if ($post && $post->id != $postId) {
            $this->isSlugPost($slug . "-2");
        } else {
            $this->_SLUG = $slug;
            return $slug;
        }
    }
}
