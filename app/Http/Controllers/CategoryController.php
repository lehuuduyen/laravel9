<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Category_transiation;
use App\Models\Config_field;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoryController extends BaseController
{
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
        return $this->renderView('layouts/category/list', ['active' => 'category'.$getPage->slug,'pageSlug'=>$getPage->slug]);
    }
    public function create()
    {
        $getPage = $this->getPage();
        $getAllCategory = $this->getAllCategory();
        $htmlCategory = $this->htmlRecursiveCategory($getAllCategory);
        

        
        return $this->renderView('layouts/category/new', ['active' => 'category'.$getPage->slug,'pageSlug'=>$getPage->slug,'htmlCategory'=>$htmlCategory]);
    }
    
    public function edit($id)
    {
        $getPage = $this->getPage();

        $getCategory = Category::with('category_transiation')->where('id',$id)->first();
       
      

        return $this->renderView('layouts/category/new', ['active' => 'category'.$getPage->slug,'pageSlug'=>$getPage->slug, 'getCategory' => $getCategory]);
    }
    public function store(Request  $request)
    {
        $getPage = $this->getPage();
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($data['name'] == null) {
                throw new Exception("Name cannot be empty");
            }
            if ($data['slug'] == null) {
                throw new Exception("Slug cannot be empty");
            }


            
            $category = Category::create(
                ['name' => $data['name'],'page_id' => $getPage->id,'status' => $data['status'], 'slug' => $data['slug'], 'img_sp' => $data['imagesp'], 'img_pc' => $data['imagepc']]
            );
            foreach ($data['languages'] as $language) {
                $categoryTransiattion = Category_transiation::create([
                    "language_id" => $language['languge_id'],
                    "category_id" => $category->id,
                    "title" => $language['title'],
                    "sub_title" => $language['sub_title'],
                    "excerpt" => $language['excerpt'],
                    "languge_id" => $language['languge_id']
                ]);
            }
          
            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return Redirect::back()->withInput($request->input())->with('error', $e->getMessage());
        }
        return Redirect::back()->with('success', 'Create success');
    }
    public function update(Request  $request, $id)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $category = Category::find($id);

            $data = $request->all();
            if ($data['name'] == null) {
                throw new Exception("Name cannot be empty");
            }
            //image

            $category->update(
                ['name' => $data['name'],'status' => $data['status'], 'img_sp' => $data['imagesp'], 'img_pc' => $data['imagepc']]
            );

            //xóa Category_transiation
            Category_transiation::where('category_id', $id)->delete();
            //add Category_transiation

            foreach ($data['languages'] as $language) {
                $categoryTransiattion = Category_transiation::create([
                    "language_id" => $language['languge_id'],
                    "category_id" => $id,
                    "title" => $language['title'],
                    "sub_title" => $language['sub_title'],
                    "excerpt" => $language['excerpt'],
                    "languge_id" => $language['languge_id']
                ]);
            }

            
            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return Redirect::back()->withInput($request->input())->with('error', $e->getMessage());
        }
        return Redirect::back()->with('success', 'Update Success');
    }
    public function destroy($id)
    {
        if (count($this->getPageByConfig($id)) == 0) {
            return $this->returnJson('', 'Delete config field success', Config_field::destroy($id));
        }
        return $this->returnJson('', 'Already have a post to use', false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
