<?php

namespace App\Http\Controllers;

use App\Models\Config_detail_field;
use Illuminate\Http\Request;
use App\Models\Config_field;

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
        foreach($configField as $key => $value){
            $countText = 0;
            $countTextArea = 0;
            $countImg = 0;
            foreach($value->config_detail_field as $configDetailField){
                if($configDetailField['type'] == Config_detail_field::typeText()){
                    $countText ++;
                }else if($configDetailField['type'] == Config_detail_field::typeTextArea()){
                    $countTextArea ++;
                } else if($configDetailField['type'] == Config_detail_field::typeImg()){
                    $countImg ++;
                }
            }
            $configField[$key]['count_text'] = $countText;
            $configField[$key]['count_textarea'] = $countTextArea;
            $configField[$key]['count_img'] = $countImg;

        }
        return view('layouts/config/list',['active'=>'config','configField' => $configField]);
    }
    public function new()
    {
        return view('layouts/config/new',['active'=>'config']);
    }
}
