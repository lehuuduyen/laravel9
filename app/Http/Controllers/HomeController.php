<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FormatLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function submitChangeLink(Request $request)
    {
        $fullDomainWithProtocol = request()->getSchemeAndHttpHost();
        $code = Str::random(4);

        $data = $request->all();
        $title = Str::slug($data['title']);
        $check = FormatLink::where('title',$title)->where('link',$data['link'])->first();
        $list = [
            "title" => $title,
            "link" => $data['link'],
            "code" => $code
        ];
        if($check){
            $list['code'] = $fullDomainWithProtocol.'/phimhay/'.$check->title.'/'.$check->code;
        }else{

            $da = FormatLink::create($list);
            $list['code'] = $fullDomainWithProtocol.'/phimhay/'.$title.'/'.$code;

        }
        
        
        $this->data =$list;
        
        return view('fontend.changeLink', $this->data);
    }
    public function ChangeLink()
    {
        $fullDomainWithProtocol = request()->getSchemeAndHttpHost();
        
        $list = [
            "title" => "",
            "link" => "",
            "code" => "",

        ];
        $this->data =$list;
        
        return view('fontend.changeLink', $this->data);
    }
    public function redirectLink($title,$code)
    {

        $check = FormatLink::where('title',$title)->where('code',$code)->first();
        if($check){
            FormatLink::where('id', $check->id)->increment('count');

            return redirect($check->link);

        }
        abort(404);
    }
    public function changeLanguage($language)
    {
        
        \Session::put('website_language', $language);
        return redirect()->back();
    }
}
