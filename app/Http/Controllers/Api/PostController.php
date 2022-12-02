<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Language;
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
        
        if(isset($_GET['page_id'])){
            $allPost =  DB::table('post')
            ->join('post_meta', 'post_meta.post_id', '=', "post.id")
            ->select('post.*','post_meta.meta_value as title')
            ->where('post.page_id', $_GET['page_id'])
            ->where('post_meta.meta_key', "title")
            ->where('post_meta.language_id', Language::ENGLISH_ID())
            ->get();
        }
        
        foreach($allPost as $key => $post){
            $allPost[$key]->update_at = date('Y-m-d H:i:s',strtotime($post->updated_at));
            $allPost[$key]->category = $this->getNameCategoryByPost($post->id);

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
