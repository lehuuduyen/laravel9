<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormConfigValidate;
use App\Models\Config_detail_field;
use Illuminate\Http\Request;
use App\Models\Config_field;
use App\Models\Language;
use Dflydev\DotAccessData\Data;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ConfigFieldController extends BaseController
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

        return $this->renderView('layouts/config/list', ['active' => 'config']);
    }
    public function create()
    {
        return $this->renderView('layouts/config/new', ['active' => 'config']);
    }
    public function edit($id)
    {
        $configFieldDetail = Config_field::with('Config_detail_field')->where('id', $id)->first();

        $temp = [];
        $array = [];
        foreach ($configFieldDetail->config_detail_field as $key => $value) {
            $temp[$value->key]['type'] = $value->type;
            $temp[$value->key]['key'] = $value->key;
            $temp[$value->key]['tags'] = $value->tags;
            $temp[$value->key]['language'][$value->language['id']] = [
                'id' => $value->id,
                'language_id' => $value->language['id'],
                'title' => $value->title,
                'slug_language' => $value->language['slug'],
            ];
        }


        $array = array_values($temp);

        $configFieldDetail->config_detail_field = $array;

        $getPageByConfig = $this->getPageByConfig($id);



        return $this->renderView('layouts/config/new', ['active' => 'config', 'configFieldDetail' => $configFieldDetail, 'listPost' => $getPageByConfig]);
    }

    public function store(Request  $request)
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
            // insert config
            $configField = Config_field::create(
                ['title' => $data['title']]
            );

            foreach ($listConfigDettail as $configDetail) {
                $array = ['language_id' => $configDetail->language_id, 'title' => $configDetail->title, 'config_field_id' => $configField->id, 'key' => $configDetail->key, 'type' => $configDetail->type];
                if ($configDetail->type > 4) {

                    $array['tags'] = $configDetail->tags;
                }
                Config_detail_field::create(
                    $array
                );
            }

            // Commit the queries!
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnJson('', $e->getMessage(), false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->returnJson($configField, 'Create config field success', true, Response::HTTP_CREATED);
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
            $checkPost = $this->getPageByConfig($id);
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
               
                foreach ($listConfigDettail as $configDetail) {
                    $array = ['language_id' => $configDetail->language_id, 'title' => $configDetail->title, 'config_field_id' => $id, 'key' => $configDetail->key, 'type' => $configDetail->type];
                    if ($configDetail->type > 4) {
                        $array['tags'] = $configDetail->tags;
                    }
                    
                    Config_detail_field::create(
                        $array
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
        if (count($this->getPageByConfig($id)) == 0) {
            return $this->returnJson('', 'Delete config field success', Config_field::destroy($id));
        }
        return $this->returnJson('', 'Already have a post to use', false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
