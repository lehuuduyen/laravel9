<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
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
        $page = new Page();
        $languageId = $page->getLanguageId();
        $data = [];
        try {
            //banner top

            $data['banner_top'] = Page::formatJsonApi('banner_top', ['img_pc', 'img_sp', 'slug'], ['title', 'excerpt']);
            //about
            $data['about'] = Page::formatJsonApi('about', ['slug'], ['title', 'excerpt', 'sub_title']);
            //services
            $data['services'] = Page::formatJsonApi('services', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'img_pc', 'img_sp']);
            //strengths
            // $data['strengths'] = Page::formatJsonApi('strengths',['slug'],['title','excerpt','sub_title'],['title','excerpt','img_pc','img_sp']);
            // works
            $data['works'] = Page::formatJsonApi('works', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt', 'img_pc', 'img_sp']);
            // news
            $data['news'] = Page::formatJsonApi('news', ['slug'], ['title', 'excerpt', 'sub_title'], ['title', 'excerpt']);
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
