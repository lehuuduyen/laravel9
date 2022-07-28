<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends BaseController
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
        return view('layouts/dashboard');
    }
    public function top()
    {
        return view('layouts/dashboard');
    }
}
