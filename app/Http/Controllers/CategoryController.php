<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Config_field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
       
        
        return $this->renderView('layouts/category/list',['active'=>'category']);
    }
    public function new()
    {
        $configField = Config_field::all();

        return $this->renderView('layouts/category/new',['active'=>'category','configField' => $configField]);
    }
    public function insert(Request  $request)
    {
        $data = $request->all();
        // // Start transaction!
        DB::beginTransaction();
      
        
        try {
            // insert config
            $category = Category::create(
                ['slug' => $data['slug'],'title' => $data['title'],'description' => $data['description']]
            );
            if(isset($data['select_list_field'])){
                foreach($data['select_list_field'] as $fieldId){
                    Category_config_field::create(
                        ['category_id' => $category->id ,'config_field_id' => $fieldId],
                    );
                }
            }
            
         
            // Commit the queries!
            DB::commit();
        }  catch (\Exception $e) {
            DB::rollback();
       
            return Redirect::back()->withInput($request->input())->with('error', $e->getMessage());

        }
        return Redirect::back()->withInput($request->input())->with('success', 'Thêm thành công');

    }
}
