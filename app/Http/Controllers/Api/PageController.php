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
use App\Models\Post_category;
use App\Models\Post_meta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;

class PageController extends BaseController
{

    public $_slugRecruit = "recruit";
    public $_slugCompany = "company";

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
            $data['about'] = Page::formatJsonApi('company', ['slug', 'img_pc', 'img_sp'], ['title', 'excerpt', 'sub_title']);
            //services
            $data['services'] = Page::formatJsonApi('service', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'thumbnail']);
            //strengths
            $data['strengths'] = Page::formatJsonApi('strengths', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt',  'img']);
            // works
            $data['works'] = Page::formatJsonApi('works', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'img_pc', 'img_sp']);
            // news
            $data['news'] = Page::formatJsonApi('news', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'category'], true);
            // recruit
            $data['recruit'] = Page::formatJsonApi('recruit', ['slug', 'img_sp', 'img_pc']);
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
            $companyInfo = Page::formatJsonApi('information', [], [], ['id', 'logo','description','keywords', 'name', 'address', 'hotline', 'location', 'working_time', 'facebook', 'twitter', 'instagram', 'linkedin']);


            $temp = new stdClass;
            if (!empty($companyInfo)) {
                $temp = [
                    'logo' => (isset($companyInfo[0]['logo'])) ? $companyInfo[0]['logo'] : "",
                    'name' => (isset($companyInfo[0]['name'])) ? $companyInfo[0]['name'] : "",
                    'address' => (isset($companyInfo[0]['address'])) ? $companyInfo[0]['address'] : "",
                    'hotline' => (isset($companyInfo[0]['hotline'])) ? $companyInfo[0]['hotline'] : "",
                    'working_time' => (isset($companyInfo[0]['working_time'])) ? $companyInfo[0]['working_time'] : "",
                    'location' => (isset($companyInfo[0]['location'])) ? $companyInfo[0]['location'] : "",
                    'description' => (isset($companyInfo[0]['description'])) ? $companyInfo[0]['description'] : "",
                    'keywords' => (isset($companyInfo[0]['keywords'])) ? $companyInfo[0]['keywords'] : "",
                    'social' => [
                        'facebook' => (isset($companyInfo[0]['facebook'])) ? $companyInfo[0]['facebook'] : "",
                        'twitter' => (isset($companyInfo[0]['twitter'])) ? $companyInfo[0]['twitter'] : "",
                        'instagram' => (isset($companyInfo[0]['instagram'])) ? $companyInfo[0]['instagram'] : "",
                        'linkedin' => (isset($companyInfo[0]['linkedin'])) ? $companyInfo[0]['linkedin'] : "",
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
                $data['excerpt'] = $page['page_transiation']['excerpt'];
                $data['description'] = $page['page_transiation']['description'];
                $list = Page::formatJsonApi($slug, [], [], ['title', 'sub_title', 'excerpt', 'description', 'category', 'img_sp', 'img_pc', 'thumbnail'], true);
                $data['list'] = $list;
            } else {
                $categorie = Category::where('slug', $slug)->first();
                if ($categorie) {
                    $data['title'] = $categorie['category_transiation_by_language']['title'];
                    $data['slug'] = $categorie['slug'];
                    $data['sub_title'] = $categorie['category_transiation_by_language']['sub_title'];
                    $data['excerpt'] = $categorie['category_transiation_by_language']['excerpt'];
                    $data['list'] = Category::getPostByCategory($categorie['id'], ['title', 'sub_title', 'thumbnail', 'excerpt', 'category']);
                }
            }
            if($slug == "service"){
                $data['page']['before'] = Page::formatJsonApi('company', ['slug', 'banner_sp', 'banner_pc'], ['title', 'sub_title']);
                $data['page']['after'] = Page::formatJsonApi('works', ['slug', 'banner_sp', 'banner_pc'], ['title', 'sub_title']);
            }
            //get page service
           
            // //type page not recruit and page not category


        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function itemDetailPost()
    {

        try {
            // theo detail post
            $data = [];
            $tempAfter = new stdClass();
            $tempBefore = new stdClass();
            if (!isset($_GET['slug'])) {
                throw new \Exception("Missing param slug");
            }
            $slug = $_GET['slug'];
            $post = Post::with('post_category')->where('slug', $slug)->first();
            if ($post) {
                $categories = Post_meta::getPostCategory($post->id);
                $postMeta = Post_meta::get_post_meta($post->id);


                $getPage = Page::with('page_transiation')->find($post->page_id);
                $data['parent']['title'] = $getPage['page_transiation']['title'];
                $data['parent']['sub_title'] = $getPage['page_transiation']['sub_title'];


                $data['title'] =  (isset($postMeta['title'])) ? $postMeta['title'] : "";
                $data['slug'] = $slug;
                $data['sub_title'] = (isset($postMeta['sub_title'])) ? $postMeta['sub_title'] : "";
                $data['img_sp'] =  (isset($postMeta['img_sp'])) ? $postMeta['img_sp'] : "";
                $data['img_pc'] =  (isset($postMeta['img_pc'])) ? $postMeta['img_pc'] : "";
                $data['excerpt'] = (isset($postMeta['excerpt'])) ? $postMeta['excerpt'] : "";
                $data['technologies'] = (isset($postMeta['technologies'])) ? json_decode($postMeta['technologies']) : [];

                $data['category'] = $categories;
                $data['updated_at'] = date('Y-m-d H:i:s', strtotime($post->updated_at));
                $before = Post::where('page_id', $post->page_id)->where('id', '<', $post->id)->first();
                if ($before) {
                    $tempBefore->title = Post_meta::get_post_meta($before->id, "title");
                    $tempBefore->thumbnail = Post_meta::get_post_meta($before->id, "thumbnail");
                    $tempBefore->slug = $before->slug;
                }
                $after = Post::where('page_id', $post->page_id)->where('id', '>', $post->id)->first();
                if ($after) {
                    $tempAfter->title = Post_meta::get_post_meta($after->id, "title");
                    $tempAfter->thumbnail = Post_meta::get_post_meta($after->id, "thumbnail");
                    $tempAfter->slug = $after->slug;
                }

                $data['page']['before'] = $tempBefore;
                $data['page']['after'] = $tempAfter;
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
                $data['excerpt'] = $page['page_transiation']['excerpt'];
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
                $data['excerpt'] = $page['page_transiation']['excerpt'];

                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'brilliant')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->list = Category::getPostByCategory($category['id'], ['title', 'sub_title', 'excerpt', 'img_sp', 'img_pc']);
                }
                $data['list']['brilliant'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'culture')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->list = Category::getPostByCategory($category['id'], ['title', 'sub_title', 'excerpt', 'img_sp', 'img_pc']);
                }
                $data['list']['culture'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'benefit')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->list = Category::getPostByCategory($category['id'], ['title', 'sub_title', 'excerpt', 'img_sp', 'img_pc']);
                }
                $data['list']['benefit'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'job')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->list = Category::getPostByCategory($category['id'], ['title', 'sub_title', 'excerpt', 'img_sp', 'img_pc']);
                }
                $data['list']['job'] = $temp;
            }

            // //type page not recruit and page not category


        } catch (\Exception $e) {
            return $this->returnJson($data, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($data, 'Data found');
    }
    public function getCompany()
    {

        $data = [];
        try {

            //type recruit
            $page = Page::where('slug',  $this->_slugCompany)->where('is_category', Category::CATEGORY_ACTIVE())->first();
            if ($page) {
                $data['title'] = $page['page_transiation']['title'];
                $data['slug'] = $page['slug'];
                $data['sub_title'] = $page['page_transiation']['sub_title'];
                $data['excerpt'] = $page['page_transiation']['excerpt'];

                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'introduce')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->list = Category::getPostByCategory($category['id'], ['title', 'sub_title', 'excerpt', 'summary', 'headline', 'img_sp', 'img_pc']);
                }
                $data['list']['introduce'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'vision')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->img_pc = (isset($category['img_pc'])) ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($category['img_pc']) : "";
                    $temp->img_sp = (isset($category['img_sp'])) ? env('APP_URL', 'http://localhost:8080') . \Storage::disk(config('juzaweb.filemanager.disk'))->url($category['img_sp']) : "";
                }
                $data['list']['vision'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'mission')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $temp->list = Category::getPostByCategory($category['id'], ['title', 'sub_title', 'excerpt', 'img_sp', 'img_pc']);
                }
                $data['list']['mission'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'map')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                }
                $data['list']['map'] = $temp;


                $category = Category::with('category_transiation_by_language')->where('page_id', $page['id'])->where('slug', 'profile')->first();
                $temp = new stdClass;
                if ($category) {
                    $temp->title = (isset($category['category_transiation_by_language']['title'])) ? $category['category_transiation_by_language']['title'] : "";
                    $temp->sub_title = (isset($category['category_transiation_by_language']['sub_title'])) ? $category['category_transiation_by_language']['sub_title'] : "";
                    $temp->excerpt = (isset($category['category_transiation_by_language']['excerpt'])) ? $category['category_transiation_by_language']['excerpt'] : "";
                    $post = Post::join('post_category', 'post_category.post_id', '=', "post.id")->select('post.*')->where('post_category.category_id', $category['id'])->first();
                    $list =[];
                    if ($post) {
                        $listKeyPostMeta = ['company_name', 'establishment', 'location', 'representative', 'business_description'];
                        foreach ($listKeyPostMeta as $keyPostMeta) {
                            $value = Post_meta::get_post_meta_title($post->id, $keyPostMeta);
                            $list[] = $value;
                        }
                    }
                    $temp->list = $list;






                }
                $data['list']['profile'] = $temp;


                //get page service
                $data['page']['before'] = Page::formatJsonApi('service', ['slug', 'banner_sp', 'banner_pc'], ['title', 'sub_title']);
                $data['page']['after'] = Page::formatJsonApi('recruit', ['slug', 'banner_sp', 'banner_pc'], ['title', 'sub_title']);
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
