<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Config_field;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Language;
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
    public function index()
    {
        $languageId = getLanguageId();
        $categories = Contact::get();
        foreach ($categories as $key => $category) {
            $listType = explode(",", $category['type']);
            $strType = "";
            foreach ($listType as $type) {
                if ($languageId ==  Language::ENGLISH_ID()) {
                    if ($type == 1) {
                        $strType .= "お仕事のご相談／ご依頼</br>";
                    } elseif ($type == 2) {
                        $strType .= "採用について</br>";
                    } else {
                        $strType .= "その他</br>";
                    }
                } else if ($languageId ==  Language::JAPAN_ID()) {
                    if ($type == 1) {
                        $strType .= "Job inquiries/requests</br>";
                    } elseif ($type == 2) {
                        $strType .= "About employment</br>";
                    } else {
                        $strType .= "Other</br>";
                    }
                }
            }
            $categories[$key]['type'] = $strType;
        }
        return $this->returnJson($categories, 'Data found');
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $code = true;
        $message = "Add Success";
        $contact = new stdClass;


        if (!isset($data['type']) && empty($data['type'])) {
            $code = false;
            $message = "Param type not null";
        }
        if (!isset($data['name']) && empty($data['name'])) {
            $code = false;
            $message = "Param name not null";
        }
        if (!isset($data['email']) && empty($data['email'])) {
            $code = false;
            $message = "Param email not null";
        }
        if ($code) {
            $data['type'] = implode(",", $data['type']);


            $contact = Contact::create($data);
        }

        return  $this->returnJson($contact, $message, $code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
        if (isset($request['status'])) {
            Contact::find($id)->update(
                ['status' => $request['status']]
            );
        }
        return  $this->returnJson("", "Update Success");
      


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
