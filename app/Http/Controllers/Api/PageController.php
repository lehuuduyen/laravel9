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
use stdClass;

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
            $data['services'] = Page::formatJsonApi('service', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'img_pc', 'img_sp']);
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
    public function formatInfo($slug, $hamburger_top)
    {
        $pageCompany = Page::where('slug', $slug)->first();
        $array = [];
        if ($pageCompany) {
            $array['title'] = strtoupper($pageCompany['slug']);
            $array['slug'] = $pageCompany['slug'];
            $array['sub_title'] = $pageCompany['page_transiation']['sub_title'];
            // $array['type'] = $this->_POST_TYPE_RECRUIT;
            array_push($hamburger_top, $array);
        }
        return $hamburger_top;
    }
    public function info()
    {
        $data = [];
        $hamburger_top = [];
        $hamburger_foot = [];
        try {
            // type top
            $array['title'] = "TOP";
            $array['slug'] = "/";
            $array['sub_title'] = "トップページ";
            $array['type'] = $this->_POST_TYPE_TOP;
            array_push($hamburger_top, $array);

            //type company
            $hamburger_top = $this->formatInfo('company', $hamburger_top);
            //type service
            $hamburger_top = $this->formatInfo('service', $hamburger_top);
            //type works
            $hamburger_top = $this->formatInfo('works', $hamburger_top);
            //type news
            $hamburger_top = $this->formatInfo('news', $hamburger_top);
            //type recruit
            $hamburger_top = $this->formatInfo('recruit', $hamburger_top);
            //type contact
            $hamburger_top = $this->formatInfo('contact', $hamburger_top);

            $data['hamburger_top'] = $hamburger_top;
            //security
            
            $hamburger_foot = $this->formatInfo('security', $hamburger_foot);
            //privacy

            $hamburger_foot = $this->formatInfo('privacy', $hamburger_foot);

            $data['hamburger_foot'] = $hamburger_foot;
            //company info
            $companyInfo = Page::formatJsonApi('company_info', [], [], ['id', 'logo', 'name', 'address', 'hotline', 'lat', 'long', 'long', 'facebook', 'twiter', 'instagram', 'linkedin']);


            $temp = new stdClass;
            if (!empty($companyInfo)) {
                $temp = [
                    'logo' => $companyInfo[0]['logo'],
                    'name' => $companyInfo[0]['name'],
                    'address' => $companyInfo[0]['address'],
                    'hotline' => $companyInfo[0]['hotline'],
                    'working_time' => $companyInfo[0]['working_time'],
                    'location' => ['lat' => $companyInfo[0]['lat'], 'long' => $companyInfo[0]['long']],
                    'social' => [
                        'facebook' => $companyInfo[0]['facebook'],
                        'twiter' => $companyInfo[0]['twiter'],
                        'instagram' => $companyInfo[0]['instagram'],
                        'linkedin' => $companyInfo[0]['linkedin'],
                    ],
                ];
            }
            $data['company_info'] = $temp;
        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function getCategoryBySlug()
    {

        try {
            //type recruit
            $data = [];

            if (!isset($_GET['slug'])) {
                throw new \Exception("Missing param slug");
            }
            $slug = $_GET['slug'];
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
                    $data['list'] = Category::getPostByCategory($categorie['id'], ['title', 'sub_title', 'img_sp', 'img_pc', 'description_sort', 'description_full', 'design_type']);
                }
            }

            // //type page not recruit and page not category


        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function itemDetail()
    {

        try {
            // theo getCategoryBySlug
            $data = [];

            if (!isset($_GET['slug'])) {
                throw new \Exception("Missing param slug");
            }
            $slug = $_GET['slug'];
            $post = Post::where('slug', $slug)->first();
            if ($post) {
                $data['title'] =  Post_meta::get_post_meta($post->id, 'title');
                $data['slug'] = $slug;
                $data['sub_title'] = Post_meta::get_post_meta($post->id, 'sub_title');
                $data['img_sp'] =  Post_meta::get_post_meta($post->id, 'img_sp');
                $data['img_pc'] =  Post_meta::get_post_meta($post->id, 'img_pc');
                $data['description_sort'] = Post_meta::get_post_meta($post->id, 'description_sort');
                $data['description_full'] = Post_meta::get_post_meta($post->id, 'description_full');
            }
        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function getPageBySlug()
    {
        if (!isset($_GET['slug'])) {
            throw new \Exception("Missing param slug");
        }
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
            } else {
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
    public function getRecruitDetail()
    {

        try {
            //type recruit
            $data = [];

            if (!isset($_GET['slug'])) {
                throw new \Exception("Missing param slug");
            }
            $slug = $_GET['slug'];
            $page = Page::where('slug',  $this->_slugRecruit)->where('is_category', Category::CATEGORY_ACTIVE())->first();

            if ($page) {
                $post = Post::where('slug', $slug)->first();
                if ($post) {
                    $data['title'] =  Post_meta::get_post_meta($post->id, 'title');
                    $data['slug'] = $slug;
                    $data['sub_title'] = Post_meta::get_post_meta($post->id, 'sub_title');
                    $data['img_sp'] =  Post_meta::get_post_meta($post->id, 'img_sp');
                    $data['img_pc'] =  Post_meta::get_post_meta($post->id, 'img_pc');
                    $data['description_sort'] = Post_meta::get_post_meta($post->id, 'description_sort');
                    $data['description_full'] = Post_meta::get_post_meta($post->id, 'description_full');
                }
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
