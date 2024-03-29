<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Page_config_field;
use App\Models\Page_transiation;
use App\Models\Config_field;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App;
use App\Models\Category;
use App\Models\Option;

class ContactController extends BaseController
{
    public $_SLUG = "";

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
        return $this->renderView('layouts/contact/list', ['active' => 'contact']);
    }
    public function create()
    {
        $configField = Config_field::all();
        $options = Option::all();
        return $this->renderView('layouts/page/new', ['active' => 'page', 'configField' => $configField, 'options' => $options]);
    }
    public function edit($id)
    {
        $configField = Config_field::all();
        $getPage = Page::with('page_config_field')->with('page_all_transiation')->where('id', $id)->first();

        $pageFiled = [];
        foreach ($getPage['page_config_field'] as $value) {
            $pageFiled[] = $value['config_field_id'];
        }
        return $this->renderView('layouts/page/new', ['active' => 'page', 'configField' => $configField, 'getPage' => $getPage, 'pageFiled' => $pageFiled]);
    }
    public function store(Request  $request)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($data['slug'] == null) {
                throw new Exception("Slug cannot be empty");
            }
            // check slug
            $this->_SLUG = $data['slug'];
            $slug = $this->isSlugPage($data['slug']);
            $slug = $this->_SLUG;



            $page = Page::create(
                ['status' => $data['status'],'banner_sp' => $data['banner_sp'],'banner_pc' => $data['banner_pc'], 'is_category' => $data['is_category'], 'slug' => $slug, 'img_sp' => $data['imagesp'], 'img_pc' => $data['imagepc']]
            );
            foreach ($data['languages'] as $language) {
                if ($language['title'] == null) {
                    throw new Exception("Title cannot be empty");
                }
                Page_transiation::create([
                    "language_id" => $language['languge_id'],
                    "page_id" => $page->id,
                    "title" => $language['title'],
                    "sub_title" => $language['sub_title'],
                    "excerpt" => $language['excerpt'],
                    "description" => $language['description'],
                ]);
            }
            if (isset($data['select_list_field'])) {
                foreach ($data['select_list_field'] as $fieldId) {
                    Page_config_field::create(
                        ['page_id' => $page->id, 'config_field_id' => $fieldId],
                    );
                }
            }
            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnJson('', $e->getMessage(), false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        return $this->returnJson($page, 'Create page success');
    }
    public function update(Request  $request, $id)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {


            $data = $request->all();
           
            $page = Page::find($id);

            if (!isset($data['select_list_field'])) {
                $data['select_list_field'] = [];
            }
            $selectListField = $data['select_list_field'];

            //kiểm tra xem page này đã tồn tại ở post chưa?
            $getPostByPage = $this->getPostByPage($id);
            if (count($getPostByPage) > 0) {
                $pageField = Page::with('page_config_field')->where('id', $id)->first();
                foreach ($pageField['page_config_field'] as $value) {
                    if (!in_array($value['config_field_id'], $selectListField)) {
                        throw new Exception("Filed is used in post ");
                    }
                }
            }




            $page->update(
                [ 'is_category' => $data['is_category'],'banner_sp' => $data['banner_sp'],'banner_pc' => $data['banner_pc'],'status' => $data['status'], 'img_sp' => $data['imagesp'], 'img_pc' => $data['imagepc']]
            );

            //xóa Page_transiation
            Page_transiation::where('page_id', $id)->delete();
            //add Page_transiation

            foreach ($data['languages'] as $language) {
                if ($language['title'] == null) {
                    throw new Exception("Title cannot be empty");
                }
                $pageTransiattion = Page_transiation::create([
                    "language_id" => $language['languge_id'],
                    "page_id" => $id,
                    "title" => $language['title'],
                    "sub_title" => $language['sub_title'],
                    "excerpt" => $language['excerpt'],
                    "description" => $language['description'],

                ]);
            }

            //xóa Page_config_field
            Page_config_field::where('page_id', $id)->delete();
            //add Page_config_field
            if (isset($data['select_list_field'])) {
                foreach ($data['select_list_field'] as $fieldId) {
                    Page_config_field::create(
                        ['page_id' => $id, 'config_field_id' => $fieldId],
                    );
                }
            }
            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return $this->returnJson('', $e->getMessage(), false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($page, 'Update page success');
    }
    public function destroy($id)
    {
        if (count($this->getPageByConfig($id)) == 0) {
            return $this->returnJson('', 'Delete config field success', Config_field::destroy($id));
        }
        return $this->returnJson('', 'Already have a post to use', false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function isSlugPage($slug, $pageId = "")
    {
        $Page = Page::where('slug', $slug)->first();
        if ($Page && $Page->id != $pageId) {
            $this->isSlugPage($slug . "-2");
        } else {
            $category = Category::where('slug', $slug)->first();
            if($category){
                $this->isSlugPage($slug . "-2");
            }else{
                $this->_SLUG = $slug;
                return $slug;
            }
          
        }
    }
}
