<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class BaseController extends Controller
{
    public function renderView($file, $param)
    {
        $listSlugCategory = [];
        $category = Category::all();
        $param['category'] = $category;
        foreach ($category as $val) {
            $listSlugCategory[] = $val->slug;
        }
        if (in_array(Request::path(), $listSlugCategory)) {
            $param['active'] = Request::path();
            $param['activeCategory'] = true;
        }
        return view($file, $param);
    }
}
