<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Config_field;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use stdClass;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {   
        $data = $request->all();
        $code = true;
        $message = "Add Success";
        $contact = new stdClass;
        
        
        if(!isset($data['type']) && empty($data['type'])){
            $code = false;
            $message = "Param type not null";
        }
        if(!isset($data['name']) && empty($data['name'])){
            $code = false;
            $message = "Param name not null";

        }
        if(!isset($data['email']) && empty($data['email'])){
            $code = false;
            $message = "Param email not null";
        }
        if($code){
            $data['type'] = implode(",",$data['type']);
            $contact = Contact::create($data)  ;     
        }
                            
        return  $this->returnJson($contact, $message,$code);
        
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
