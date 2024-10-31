<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['active'] = 'dashboard';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Category = Category::get();
       
        $this->data['categories'] = $Category;
        
        return view('fontend.index', $this->data);
    }
    public function changeLanguage($language)
    {
        
        \Session::put('website_language', $language);
        return redirect()->back();
    }
}
