<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormConfigValidate;
use App\Models\Config_detail_field;
use Illuminate\Http\Request;
use App\Models\Config_field;
use App\Models\Language;
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
        
        return $this->renderView('layouts/config/list', ['active' => 'config']);
    }
    public function create()
    {
        return $this->renderView('layouts/config/new', ['active' => 'config']);
    }
    public function edit($id)
    {
        $configFieldDetail = Config_field::with('Config_detail_field')->where('id',$id)->first();

        $temp = [];
        $array = [];
        foreach($configFieldDetail->config_detail_field as $key => $value){
            $temp[$value->key]['type'] = $value->type;
            $temp[$value->key]['key'] = $value->key;
            $temp[$value->key]['language'][$value->language['id']] = [
                'id'=> $value->id,
                'language_id'=> $value->language['id'],
                'title' =>$value->title,
                'slug_language' =>$value->language['slug'],
            ] ;
        }
     
        
        $array = array_values($temp);

        $configFieldDetail->config_detail_field = $array;
        
        $getPostByConfig = $this->getPostByConfig($id);
        
        
        
        return $this->renderView('layouts/config/new', ['active' => 'config','configFieldDetail'=>$configFieldDetail,'listPost'=>$getPostByConfig]);
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
                    ['language_id' => $configDetail->language_id ,'title' => $configDetail->title ,'config_field_id' => $configField->id,'key' => $configDetail->key,'type' => $configDetail->type],
                );
            }
         
            // Commit the queries!
            DB::commit();
        }  catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function update(Request  $request,$id)
    {
        $data = $request->all();
       
        
        // // Start transaction!
        DB::beginTransaction();

        try {
            // insert config
            $configField = Config_field::where('id',$id)->update(
                ['title' => $data['title']]
            );
            //update config
            $listConfigDettail = json_decode($data['json']);
            foreach($listConfigDettail as $configDetail){
                $find = DB::table('config_detail_field')->where([
                    'key'=>$configDetail->key,
                    'type'=>$configDetail->type,
                    'config_field_id'=>$id,
                    'language_id' => $configDetail->language_id,
                ])->first();
                if($find){
                    Config_detail_field::where('id',$find->id)->update(
                        ['title' => $configDetail->title ]
                    );
                }else{
                    Config_detail_field::create(
                        ['language_id' => $configDetail->language_id ,'title' => $configDetail->title ,'config_field_id' =>$id,'key' => $configDetail->key,'type' => $configDetail->type],
                    );
                }
               
            }
         
            // Commit the queries!
            DB::commit();
        }  catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function destroy($id){
       return Config_field::destroy($id);

    }
}
