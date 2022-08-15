<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Category_transiation;
use App\Models\Config_field;
use Exception;
use Illuminate\Http\Request;
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
        $configFieldDetail = Config_field::with('Config_detail_field')->where('id', $id)->first();

        $temp = [];
        $array = [];
        foreach ($configFieldDetail->config_detail_field as $key => $value) {
            $temp[$value->key]['type'] = $value->type;
            $temp[$value->key]['key'] = $value->key;
            $temp[$value->key]['language'][$value->language['id']] = [
                'id' => $value->id,
                'language_id' => $value->language['id'],
                'title' => $value->title,
                'slug_language' => $value->language['slug'],
            ];
        }


        $array = array_values($temp);

        $configFieldDetail->config_detail_field = $array;

        $getPostByConfig = $this->getPostByConfig($id);



        return $this->renderView('layouts/config/new', ['active' => 'config', 'configFieldDetail' => $configFieldDetail, 'listPost' => $getPostByConfig]);
    }
    public function store(Request  $request)
    {
        // // Start transaction!
        DB::beginTransaction();
        try {
            $data = $request->all();
           
                  
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
                ['name' => $data['name'],'slug' => $data['slug'], 'img_sp' => $fileNameSp, 'img_pc' => $fileNamePc]
            );
            foreach($data['languages'] as $language){
                $categoryTransiattion = Category_transiation::create([
                    "language_id"=>$language['languge_id'],
                    "category_id"=>$category->id,
                    "title"=>$language['title'],
                    "sub_title"=>$language['sub_title'],
                    "excerpt"=>$language['excerpt'],
                    "languge_id"=>$language['languge_id']
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
        $data = $request->all();


        // // Start transaction!
        DB::beginTransaction();

        try {
            if ($data['title'] == null) {
                throw new Exception("Title cannot be empty");
            }
            $listConfigDettail = json_decode($data['json']);

            $tempKey = [];

            foreach ($listConfigDettail as $json) {
                if ($json->key == null) {
                    throw new Exception("Key cannot be empty");
                }
                if ($json->language_id != 1) {
                    continue;
                }
                if (in_array($json->key, $tempKey)) {
                    throw new Exception("The key can't be the same");
                }
                $tempKey[] = $json->key;
            }
            //check bai post
            $checkPost = $this->getPostByConfig($id);
            // update config
            $configField = Config_field::where('id', $id)->update(
                ['title' => $data['title']]
            );
            if (count($checkPost) > 0) {
                //update config field detail
                foreach ($listConfigDettail as $configDetail) {

                    $find = DB::table('config_detail_field')->where([
                        'key' => $configDetail->key,
                        'type' => $configDetail->type,
                        'config_field_id' => $id,
                        'language_id' => $configDetail->language_id,
                    ])->first();

                    if ($find) {
                        Config_detail_field::where('id', $find->id)->update(
                            ['title' => $configDetail->title]
                        );
                    } else {
                        Config_detail_field::create(
                            ['language_id' => $configDetail->language_id, 'title' => $configDetail->title, 'config_field_id' => $id, 'key' => $configDetail->key, 'type' => $configDetail->type],
                        );
                    }
                }
            } else {
                Config_detail_field::where('config_field_id', $id)->delete();
                foreach ($listConfigDettail as $configDetail) {
                    Config_detail_field::create(
                        ['language_id' => $configDetail->language_id, 'title' => $configDetail->title, 'config_field_id' => $id, 'key' => $configDetail->key, 'type' => $configDetail->type],
                    );
                }
            }

            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnJson('', $e->getMessage(), false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->returnJson($configField, 'Updated config field success');
    }
    public function destroy($id)
    {
        if (count($this->getPostByConfig($id)) == 0) {
            return $this->returnJson('', 'Delete config field success', Config_field::destroy($id));
        }
        return $this->returnJson('', 'Already have a post to use', false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    
}
