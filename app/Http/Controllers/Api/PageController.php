<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Page;
use App\Models\Config_detail_field;
use App\Models\Config_field;
use App\Models\Language;
use App\Models\Page_transiation;
use App\Models\Post;
use App\Models\Post_meta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends BaseController
{
        
    public $_slugRecruit = "recruit";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allPage = Page::with('page_transiation')->get();

        foreach ($allPage as $key => $page) {
            $allPage[$key]['update_at'] = date('Y-m-d H:i:s', strtotime($page['updated_at']));
            $allPage[$key]['title'] = $page['page_transiation']->title;
        }
        return $this->returnJson($allPage, 'Data found');
    }
    public function topPage()
    {

        $data = [];
        try {

            //banner top
            $data['banner_top'] = Page::formatJsonApi('banner_top', ['img_pc', 'img_sp', 'slug'], ['title', 'excerpt']);
            //about
            $data['about'] = Page::formatJsonApi('about', ['slug'], ['title', 'excerpt', 'sub_title']);
            //services
            $data['services'] = Page::formatJsonApi('services', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'img_pc', 'img_sp']);
            //strengths
            $data['strengths'] = Page::formatJsonApi('strengths', [], [], ['title', 'excerpt', 'sub_title']);
            // works
            $data['works'] = Page::formatJsonApi('works', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'img_pc', 'img_sp']);
            // news
            $data['news'] = Page::formatJsonApi('news', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt']);
        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function info()
    {
        $data = [];
        try {
            //type recruit
            $pageRecruit = Page::where('slug', 'recruita')->first();
            $pageRecruitId = "";
            $hamburger_top = [];
            $array = [];
            if ($pageRecruit) {
                $pageRecruitId = $pageRecruit['id'];
                $array['title'] = $pageRecruit['page_transiation']['title'];
                $array['slug'] = $pageRecruit['slug'];
                $array['sub_title'] = $pageRecruit['page_transiation']['sub_title'];
                $array['type'] = $this->_POST_TYPE_RECRUIT;
                array_push($hamburger_top, $array);
            }

            // //type page not recruit and page not category
            if ($pageRecruitId) {
                $pageNotRecruit = Page::where('id', '!=', $pageRecruit['id'])->get();
            } else {
                $pageNotRecruit = Page::get();
            }



            foreach ($pageNotRecruit as $key => $page) {
                $temp = [];
                $temp['title'] = $page['page_transiation']['title'];
                $temp['slug'] = $page['slug'];
                $temp['sub_title'] = $page['page_transiation']['sub_title'];
                if ($page['is_category'] == 1) {
                    $temp['type'] = $this->_POST_TYPE_CATEGORY;
                } else {
                    $temp['type'] = $this->_POST_TYPE_PAGE;
                }
                array_push($hamburger_top, $temp);
            }
            // //list category
            $categories = Category::with('category_transiation_by_language')->get();


            foreach ($categories as $key => $category) {
                $temp = [];
                $temp['title'] = $category['category_transiation_by_language']['title'];
                $temp['slug'] = $category['slug'];
                $temp['sub_title'] = $category['category_transiation_by_language']['sub_title'];
                $temp['type'] = $this->_POST_TYPE_CATEGORY;
                array_push($hamburger_top, $temp);
            }
            $data['hamburger_top'] = $hamburger_top;
            //about
            $data['hamburger_foot'] = $hamburger_top;
        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function getCategoryBySlug()
    {
        $slug = $_GET['slug'];


        $data = [];
        try {
            //type recruit
            $page = Page::where('slug', $slug)->where('is_category', Category::CATEGORY_ACTIVE())->first();

            if ($page) {
                $data['title'] = $page['page_transiation']['title'];
                $data['slug'] = $page['slug'];
                $data['sub_title'] = $page['page_transiation']['sub_title'];
                $data['description'] = $page['page_transiation']['description'];
                $list = Page::formatJsonApi($slug, [], [], ['title', 'sub_title', 'img_sp', 'img_pc', 'description_sort', 'description_full', 'design_type']);
                $data['list'] = $list;
            } else {
                $categorie = Category::where('slug', $slug)->first();
                if ($categorie) {
                    $data['title'] = $categorie['category_transiation_by_language']['title'];
                    $data['slug'] = $categorie['slug'];
                    $data['sub_title'] = $categorie['category_transiation_by_language']['sub_title'];
                    $data['description'] = $categorie['category_transiation_by_language']['description'];
                    $data['list'] = Category::getPostByCategory($categorie['id'],['title', 'sub_title', 'img_sp', 'img_pc', 'description_sort', 'description_full', 'design_type']);
                }
            }

            // //type page not recruit and page not category


        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function getPageBySlug()
    {
        $slug = $_GET['slug'];


        $data = [];
        try {
            //type recruit
            $page = Page::where('slug', $slug)->where('is_category', Category::CATEGORY_UN_ACTIVE())->first();

            if ($page) {
                $data['title'] = $page['page_transiation']['title'];
                $data['slug'] = $page['slug'];
                $data['sub_title'] = $page['page_transiation']['sub_title'];
                $data['description'] = $page['page_transiation']['description'];
            } else{
                return $this->returnJson($data, 'Data not found');
            }

            // //type page not recruit and page not category


        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function getRecruit()
    {

        $data = [];
        try {
            //type recruit
            $page = Page::where('slug',  $this->_slugRecruit)->where('is_category', Category::CATEGORY_ACTIVE())->first();
            if ($page) {
                $data['title'] = $page['page_transiation']['title'];
                $data['slug'] = $page['slug'];
                $data['sub_title'] = $page['page_transiation']['sub_title'];
                $data['description'] = $page['page_transiation']['description'];
                $list = Page::formatJsonApi($this->_slugRecruit, [], [], ['title', 'sub_title', 'img_sp', 'img_pc', 'description_sort', 'description_full', 'design_type']);
                $data['list'] = $list;
            } 

            // //type page not recruit and page not category


        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
