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
        return $this->renderView('layouts/category/list', ['active' => 'category']);
    }
    public function create()
    {
        $configField = Config_field::all();

        return $this->renderView('layouts/category/new', ['active' => 'category', 'configField' => $configField]);
    }
    public function edit($id)
    {
        $configField = Config_field::all();
        $getCategory = Category::with('category_config_field')->with('category_transiation')->find($id)->first();
        $categoryFiled = [];
        foreach ($getCategory['category_config_field'] as $value) {
            $categoryFiled[] = $value['id'];
        }

        return $this->renderView('layouts/category/new', ['active' => 'category', 'configField' => $configField, 'getCategory' => $getCategory, 'categoryFiled' => $categoryFiled]);
    }
    public function store(Request  $request)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($data['name'] == null) {
                throw new Exception("Name cannot be empty");
            }

            $fileNameSp = "";
            $fileNamePc = "";
            if ($request->hasFile('imgsp')) {
                $file = $request->imgsp;

                $fileNameSp = time() . "_" . $file->getClientOriginalName();
                Storage::putFileAs('public', $file, $fileNameSp);
                // $file->move('app/public/', $file->getClientOriginalName());
                // //Lấy Tên files $file->getClientOriginalName()
                // //Lấy Đuôi File $file->getClientOriginalExtension()
                // //Lấy đường dẫn tạm thời của file $file->getRealPath()
                // //Lấy kích cỡ của file đơn vị tính theo bytes $file->getSize()
                // //Lấy kiểu file $file->getMimeType()

            }
            if ($request->hasFile('imgpc')) {
                $file = $request->imgpc;
                $fileNamePc = time() . "_" . $file->getClientOriginalName();
                Storage::putFileAs('public', $file, $fileNamePc);
            }

            $category = Category::create(
                ['name' => $data['name'], 'slug' => $data['slug'], 'img_sp' => $fileNameSp, 'img_pc' => $fileNamePc]
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
            if (isset($data['select_list_field'])) {
                foreach ($data['select_list_field'] as $fieldId) {
                    Category_config_field::create(
                        ['category_id' => $category->id, 'config_field_id' => $fieldId],
                    );
                }
            }
            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return Redirect::back()->withInput($request->input())->with('error', $e->getMessage());
        }
        return Redirect::back()->with('success', 'Thêm thành công');
    }
    public function update(Request  $request, $id)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($data['name'] == null) {
                throw new Exception("Name cannot be empty");
            }
            echo '<pre>';
            print_r($data);
            die;
            

            $fileNameSp = "";
            $fileNamePc = "";
            if ($request->hasFile('imgsp')) {
                $file = $request->imgsp;

                $fileNameSp = time() . "_" . $file->getClientOriginalName();
                Storage::putFileAs('public', $file, $fileNameSp);
                // $file->move('app/public/', $file->getClientOriginalName());
                // //Lấy Tên files $file->getClientOriginalName()
                // //Lấy Đuôi File $file->getClientOriginalExtension()
                // //Lấy đường dẫn tạm thời của file $file->getRealPath()
                // //Lấy kích cỡ của file đơn vị tính theo bytes $file->getSize()
                // //Lấy kiểu file $file->getMimeType()

            }
            if ($request->hasFile('imgpc')) {
                $file = $request->imgpc;
                $fileNamePc = time() . "_" . $file->getClientOriginalName();
                Storage::putFileAs('public', $file, $fileNamePc);
            }

            $category = Category::create(
                ['name' => $data['name'], 'slug' => $data['slug'], 'img_sp' => $fileNameSp, 'img_pc' => $fileNamePc]
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
            if (isset($data['select_list_field'])) {
                foreach ($data['select_list_field'] as $fieldId) {
                    Category_config_field::create(
                        ['category_id' => $category->id, 'config_field_id' => $fieldId],
                    );
                }
            }
            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return Redirect::back()->withInput($request->input())->with('error', $e->getMessage());
        }
        return Redirect::back()->with('success', 'Thêm thành công');
    }
    public function destroy($id)
    {
        if (count($this->getPostByConfig($id)) == 0) {
            return $this->returnJson('', 'Delete config field success', Config_field::destroy($id));
        }
        return $this->returnJson('', 'Already have a post to use', false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
