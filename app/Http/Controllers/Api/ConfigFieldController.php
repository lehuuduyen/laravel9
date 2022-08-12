<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Config_detail_field;
use App\Models\Config_field;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConfigFieldController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configField = Config_field::with('Config_detail_field')->get();


        foreach ($configField as $key => $value) {


            $countText = 0;
            $countTextArea = 0;
            $countImg = 0;
            foreach ($value->config_detail_field as $configDetailField) {
                if ($configDetailField->language_id != 1) {
                    continue;
                }
                if ($configDetailField['type'] == Config_detail_field::typeText()) {
                    $countText++;
                } else if ($configDetailField['type'] == Config_detail_field::typeTextArea()) {
                    $countTextArea++;
                } else if ($configDetailField['type'] == Config_detail_field::typeImg()) {
                    $countImg++;
                }
            }
            
           
            $configField[$key]['update_at'] = date('Y-m-d H:i:s',strtotime($value['updated_at']));
            
            $configField[$key]['count_text'] = $countText;
            $configField[$key]['count_textarea'] = $countTextArea;
            $configField[$key]['count_img'] = $countImg;

            $configField[$key]['list_post'] = $this->getPostByConfig($value->id);
        }
      
        return response()->json(['data'=>$configField], Response::HTTP_OK);
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
