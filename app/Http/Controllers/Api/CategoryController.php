<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Config_detail_field;
use App\Models\Config_field;
use App\Models\Language;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allCategory = Category::get();
        $data = [];

        if (!isset($_GET['post_type'])) {
            return $this->returnJson($data, 'Missing param post_type',false);
        }
        $page = Page::with('page_transiation')->where('slug', $_GET['post_type'])->first();
        if($page){

            $data['title'] = (isset($page['page_transiation']->title))?$page['page_transiation']->title:"";
            $data['sub_title'] = (isset($page['page_transiation']->sub_title))?$page['page_transiation']->sub_title:"";
            $data['slug'] = $page['slug'];
            $data['excerpt'] = (isset($page['page_transiation']->excerpt))?$page['page_transiation']->excerpt:"";
            $data['update_at'] = date('Y-m-d H:i:s', strtotime($page->updated_at));
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
