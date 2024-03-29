<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['active' => 'dashboard']);
    }
    public function changeLanguage($language)
    {
        
        \Session::put('website_language', $language);
        return redirect()->back();
    }
}
