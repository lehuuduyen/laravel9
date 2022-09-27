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
            $data['strengths'] = Page::formatJsonApi('strengths',[],[],['title','excerpt', 'sub_title']);
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
            $pageRecruit = Page::with('page_transiation')->where('slug','recruit')->first();

            $hamburger_top=[];
            $array=[];
            $array['title'] = $pageRecruit['page_transiation']['title'];
            $array['slug'] = $pageRecruit['slug'];
            $array['sub_title'] = $pageRecruit['page_transiation']['sub_title'];
            $array['type'] = $this->_POST_TYPE_RECRUIT;
            
            array_push($hamburger_top,$array);
            // //type page not recruit and page not category
            // foreach($pageRecruit as $key => $page){
            //     $hamburger_top[$key]['title'] = $page['page_transiation']['title'];
            //     $hamburger_top[$key]['slug'] = $page['slug'];
            //     $hamburger_top[$key]['sub_title'] = $page['page_transiation']['sub_title'];
            //     $hamburger_top[$key]['type'] = $this->_POST_TYPE_RECRUIT;
            // }
            
            $data['hamburger_top'] = $hamburger_top;
            //about
            $data['hamburger_foot'] =2;
           
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
