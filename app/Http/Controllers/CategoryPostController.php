<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryPost;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\SliderModel;
use Auth;
class CategoryPostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function all_category_post()
    {
        $this->AuthLogin();

        $category = CategoryPost::get();
        $all_category_post = DB::table('tbl_category_post')->paginate(10);
        // $manager_category_post = view('admin.all_category_post')->with('all_category_post',$all_category_post)->with('category',$category);
        return view('admin.category_post.all_category_post')->with(compact('all_category_post','category'));

    }

    public function add_category_post()
    {
        $this->AuthLogin();
        return view('admin.category_post.add_category_post');
    }
    public function save_category_post(Request $request)
    {
        $this->AuthLogin();
        $data= $request->all();
        // dd($data);
        $category = new CategoryPost();
        $category->cate_post_name = $data['category_post_name'];
        $category->cate_post_slug = $data['slug_category_post'];
        $category->meta_keywords = $data['category_post_keywords'];
        $category->cate_post_desc = $data['category_post_description'];
        $category->cate_post_status = $data['category_post_status'];
        $category->save();

        // session::put('message','Adding category post successful');
        return redirect()->back()->with('message','Adding category post successful');
    }
    public function active_category_post($category_post_id) {
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id', $category_post_id)->update(['cate_post_status'=>0]);
        // session::put('message','List category Post active');
        return redirect()->back()->with('message','active category post successful');
    }
    public function unactive_category_post($category_post_id) {
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id', $category_post_id)->update(['cate_post_status'=>1]);
        // session::put('message','List category Post unactive');
        return redirect()->back()->with('message','unactive category post successful');
    }
    public function edit_category_post($category_post_id)
    {
        $this->AuthLogin();
        $cate = CategoryPost::get();
        $edit_category_post = DB::table('tbl_category_post')->where('category_post_id',$category_post_id)->get();
        // $manager_category_post = view('admin.edit_category_post')->with('edit_category_post',$edit_category_post);
        // return view('admin_layout')->with('admin.edit_category_post',$manager_category_post);
        return view('admin.category_post.edit_category_post')->with(compact('edit_category_post','cate'));
    }
    public function update_category_post(Request $request,$category_post_id)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['category_name'] = $request->category_post_name;
        // $data['slug_category_post'] = $request->slug_category_post;
        // $data['meta_keywords'] = $request->category_post_keywords;
        // $data['category_description'] = $request->category_post_description;

        // DB::table('tbl_category_post')->where('category_id', $category_post_id)->update($data);
        $data = $request->all();
        $category = CategoryPost::find($category_post_id);
        $category->cate_post_name = $data['category_post_name'];
        $category->cate_post_slug = $data['slug_category_post'];
        $category->meta_keywords = $data['category_post_keywords'];
        $category->cate_post_desc = $data['category_post_description'];
        // $category->cate_post_status = $data['category_post_status'];
        $category->save();

        // session::put('message','update category post successful');
        return Redirect::to('all-category-post')->with('message','update category post successful');

    }
    public function delete_category_post($category_post_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id', $category_post_id)->delete();
        // session::put('message','delete category post successful');
        return Redirect::to('all-category-post')->with('message','delete category post successful');

    }
    //show home post news
    public function show_category_post_home(Request $request,$category_post_slug){
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

    //     $category_by_id = DB::table('tbl_product')
    //     ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
    //     ->where('tbl_category_product.slug_category_product',$slug_category_product)->get();

        foreach($cate_product as $key => $val){
            $meta_desc = $val->category_description;
            $meta_title= $val->category_name;
            $meta_keywords= $val->meta_keywords;
            $url_canonical = $request->url();
        }

    //     $category_name = DB::table('tbl_category_product')->where('slug_category_product', $slug_category_product)->limit(1)->get();

        // return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
     }
}
