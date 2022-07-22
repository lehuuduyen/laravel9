<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormConfigValidate;
use App\Models\Config_detail_field;
use Illuminate\Http\Request;
use App\Models\Config_field;
use Dflydev\DotAccessData\Data;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

class ConfigFieldController extends Controller
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
        return view('layouts/config/list', ['active' => 'config', 'configField' => $configField]);
    }
    public function new()
    {

        return view('layouts/config/new', ['active' => 'config']);
    }
    public function insert(Request  $request)
    {
        $data = $request->all();
     
        // // Start transaction!
        DB::beginTransaction();

        try {
            // insert config
            $configField = Config_field::create(
                ['title' => $data['title']],
                ['key' => $data['key']]
            );
            
            $listConfigDettail = json_decode($data['json']);
            foreach($listConfigDettail as $configDetail){
                
                
                Config_detail_field::create(
                    ['title' => $configDetail->title ,'config_field_id' => $configField->id,'key' => $configDetail->key,'type' => $configDetail->type],
                );
            }
         
            // Commit the queries!
            DB::commit();
        } catch (ValidationException $e) {
            // Rollback and then redirect
            // back to form with errors
            DB::rollback();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
