<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_config_field;
use App\Models\Language;
use App\Models\Page;
use App\Models\Page_config_field;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class BaseController extends Controller
{
    public $_html = "";
    public $_stt = 0;
    public function htmlRecursiveCategory($getAllCategory)
    {


        $html = '<div class="show-taxonomies taxonomy-categories">
        <ul class="mt-2 p-0">';
        $this->recursiveCategory($getAllCategory, NULL, False);
        $html .= $this->_html;


        $html .= ' </ul></div>';
        return $html;
    }
    public function recursiveCategory($getAllCategory, $parent_id = NULL, $char = '')
    {
        $html = '';
        foreach ($getAllCategory as $key => $item) {


            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                if ($char !== False && $parent_id == NULL) {
                    for($i=1;$i<=$this->_stt;$i++){
                        $this->_html.='</li>';
                        $this->_html.='</ul>';
                    }
                    $this->_stt =0;

                }
                if($parent_id ==NULL){
                    $char = '<li class="m-1" id="item-category-'.$item->id.'">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="categories[]" class="custom-control-input" id="categories-'.$item->id.'" value="'.$item->id.'">
                        <label class="custom-control-label" for="categories-'.$item->id.'">' . $item->name . '</label>
                    </div>
                    ';
                }else{
                    $this->_stt++;
                    $char ='<ul class="ml-3 p-0">
                    <li class="m-1" id="item-category-'.$item->id.'">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="categories[]" class="custom-control-input"
                                id="categories-'.$item->id.'" value="'.$item->id.'">
                            <label class="custom-control-label" for="categories-'.$item->id.'">' . $item->name . '</label>
                        </div>';
                }
                
                $this->_html .= $char;
                // echo '<option value="' . $item->id . '">';
                // echo $char . $item->name;
                // echo '</option>';

                // Xóa chuyên mục đã lặp
                unset($getAllCategory[$key]);



                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->recursiveCategory($getAllCategory, $item->id, $char);
            }
        }
    }
    public function renderView($file, $param=[])
    {



        $listSlugCategory = [];
        $page = Page::with('page_transiation')->where('status', 1)->get();


        $param['page'] = $page;
        foreach ($param['page'] as $key => $val) {

            $param['page'][$key]['title'] = $val['page_transiation']->title;
            $listSlugCategory[] = $val->slug;
        }
        if (in_array(Request::path(), $listSlugCategory)) {
            $param['active'] = Request::path();
            $param['activePage'] = true;
        }

        //list language
        $allLanguage = Language::get();
        $param['allLanguage'] = $allLanguage;
        $param['slugLanguage'] = \Session::get('website_language', config('app.locale'));
        $param['admin_prefix'] = config('app.admin_prefix');

        return view($file, $param);
    }
    public function storeImage($request)
    {
        $path = $request->storeAs('public/profile', "abc.png");
        return substr($path, strlen('public/'));
    }
    public function getPage()
    {
        if (isset($_GET['post_type'])) {
            $slug = $_GET['post_type'];
            $getPage = Page::with('page_transiation')->where('slug', $slug)->where('status', 1)->first();

            if ($getPage) {
                $getPage['title'] = $getPage['page_transiation']['title'];

                return $getPage;
            }
        }
        return $this->error("Empty", "Page not exists");
    }
    public function getAllCategory($whereNotIn = "")
    {
        $allCategory = [];
        if (isset($_GET['post_type'])) {
            $slug = $_GET['post_type'];
            $allCategory =  DB::table('category')
                ->select("category.*")
                ->join('page', 'page.id', '=', 'category.page_id')
                ->where('page.slug', $slug);
            if($whereNotIn){
                $allCategory =  $allCategory->whereNotIn('category.id',$whereNotIn);

            }
            $allCategory =  $allCategory->get()->toArray();
        }
        return $allCategory;
    }

    public function error($title, $content)
    {
        # code...
        $data['title'] = $title;
        $data['name'] = $content;
        abort(404);
    }

    public function getPageByConfig($id)
    {
        # code...
        $Page_config_field = Page_config_field::where('config_field_id', $id)->pluck('page_id');
        return $Page_config_field;
    }
    public function getPostByPage($id)
    {
        # code...
        $listPost = Post::where('page_id', $id)->pluck('id');
        return $listPost;
    }
    public function getNameCategoryByPost($postId)
    {
        # code...
        $str="";
        $listCategory = 
        DB::table('category')
                ->join('post_category', 'category.id', '=', 'post_category.category_id')
                ->where('post_category.post_id', $postId)->pluck('name');
                foreach($listCategory as $key => $name){
                    $str.=$name;
                    if($key +1 < count($listCategory)){
                        $str .=", ";
                    }
                }
        return $str;
    }
    public function returnJson($data, $message = '', $status = true, $code = Response::HTTP_OK)
    {
        return response()->json(
            [
                'success' => $status,
                'data' => $data,
                'message' => $message
            ],
            $code
        );
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
