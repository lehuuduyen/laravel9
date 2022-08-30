<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPost = [];
        if(isset($_GET['post_type'])){
            $allPost =  DB::table('post')
            ->select('post.*','category.name as name_category')
            ->join('page', 'page.id', '=', 'post.page_id')
            ->join('post_category', 'post_category.post_id', '=', 'post.id')
            ->join('category', 'post_category.category_id', '=', 'category.id')
            ->where('post.slug', $_GET['post_type'])
            ->get();
        }
        foreach($allPost as $key => $Post){
            $allPost[$key]['update_at'] = date('Y-m-d H:i:s',strtotime($Post['updated_at']));
        }
        return $this->returnJson($allPost,'Data found');
        
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
