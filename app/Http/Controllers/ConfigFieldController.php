<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormConfigValidate;
use App\Models\Config_detail_field;
use Illuminate\Http\Request;
use App\Models\Config_field;
use Dflydev\DotAccessData\Data;
use Dotenv\Exception\ValidationException;
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
        $configField = Config_field::with('Config_detail_field')->get();
        foreach ($configField as $key => $value) {
            $countText = 0;
            $countTextArea = 0;
            $countImg = 0;
            foreach ($value->config_detail_field as $configDetailField) {
                if ($configDetailField['type'] == Config_detail_field::typeText()) {
                    $countText++;
                } else if ($configDetailField['type'] == Config_detail_field::typeTextArea()) {
                    $countTextArea++;
                } else if ($configDetailField['type'] == Config_detail_field::typeImg()) {
                    $countImg++;
                }
            }
            $configField[$key]['count_text'] = $countText;
            $configField[$key]['count_textarea'] = $countTextArea;
            $configField[$key]['count_img'] = $countImg;
        }
        return $this->renderView('layouts/config/list', ['active' => 'config', 'configField' => $configField]);
    }
    public function create()
    {
        return $this->renderView('layouts/config/new', ['active' => 'config']);
    }
    public function edit($id)
    {
        $configFieldDetail = Config_field::with('Config_detail_field')->where('id',$id)->first();
        return $this->renderView('layouts/config/new', ['active' => 'config','configFieldDetail'=>$configFieldDetail]);
    }
    
    public function store(Request  $request)
    {
        $data = $request->all();
     
        // // Start transaction!
        DB::beginTransaction();

        try {
            // insert config
            $configField = Config_field::create(
                ['title' => $data['title']]
            );
            
            $listConfigDettail = json_decode($data['json']);
            foreach($listConfigDettail as $configDetail){
                
                
                Config_detail_field::create(
                    ['title' => $configDetail->title ,'config_field_id' => $configField->id,'key' => $configDetail->key,'type' => $configDetail->type],
                );
            }
         
            // Commit the queries!
            DB::commit();
        }  catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function update(Request  $request)
    {
        $data = $request->all();
     
        // // Start transaction!
        DB::beginTransaction();

        try {
            // insert config
            $configField = Config_field::create(
                ['title' => $data['title']]
            );
            
            $listConfigDettail = json_decode($data['json']);
            foreach($listConfigDettail as $configDetail){
                
                
                Config_detail_field::create(
                    ['title' => $configDetail->title ,'config_field_id' => $configField->id,'key' => $configDetail->key,'type' => $configDetail->type],
                );
            }
         
            // Commit the queries!
            DB::commit();
        }  catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
