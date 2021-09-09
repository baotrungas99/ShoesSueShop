<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\SliderModel;
use App\Models\Category;
use Session;
use Illuminate\Support\Facades\DB;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;
use App\Models\CategoryPost;
use Auth;
session_start();

class CategoryProduct extends Controller
{
    // Funtion Admin page
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function all_category_product()
    {
        $this->AuthLogin();
        // $all_category_product = array();
        // $manager_category_product = array();
        $category = Category::get();
        $all_category_product = Category::paginate(10);
        // $all_category_product = DB::table('tbl_category_product')->paginate(10);
        // $manager_category_product = view('admin.category_product.all_category_product')->with('all_category_product',$all_category_product)->with('category',$category);
        // return view('admin_layout')->with('admin.category_product.all_category_product',$manager_category_product);
        return view('admin.category_product.all_category_product')->with(compact('category','all_category_product'));
        /*echo '<pre>';
        print_r($all_category_product);
        echo '</pre>';*/
    }

    public function add_category_product()
    {
        $this->AuthLogin();
        $cate = Category::where('category_parent',0)->get();
        return view('admin.category_product.add_category_product')->with(compact('cate'));
    }
    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['slug_category_product'] = $request->slug_category_product;
        // $data['meta_keywords'] = $request->category_product_keywords;
        // $data['category_description'] = $request->category_product_description;
        // $data['category_status'] = $request->category_product_status;
        // $data['category_parent'] = $request->depend_on;

        // DB::table('tbl_category_product')->insert($data);
        $data= $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->slug_category_product = $data['slug_category_product'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_description = $data['category_product_description'];
        $category->category_status = $data['category_product_status'];
        $category->category_parent = $data['depend_on'];
        $category->save();


        session::put('message','Adding category product successful');
        return Redirect::to('add-category-product');
    }
    public function active_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
        session::put('message','List category prodcut active');
        return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
        session::put('message','List category prodcut unactive');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $cate = Category::get();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        // $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        // return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
        return view('admin.category_product.edit_category_product')->with(compact('edit_category_product','cate'));
    }
    public function update_category_product(Request $request,$category_product_id)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['slug_category_product'] = $request->slug_category_product;
        // $data['meta_keywords'] = $request->category_product_keywords;
        // $data['category_description'] = $request->category_product_description;

        // DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        $data = $request->all();
        $category =  Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->slug_category_product = $data['slug_category_product'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_description = $data['category_product_description'];
        // $category->category_status = $data['category_product_status'];
        $category->category_parent = $data['depend_on'];
        $category->save();

        session::put('message','update category product successful');
        return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
         DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        session::put('message','delete category product successful');
        return Redirect::to('all-category-product');

    }
    // end funtion Admin Page
    // Funtion Home page
    public function show_category_home(Request $request,$slug_category_product){
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_category_product.slug_category_product',$slug_category_product)->get();

        foreach($cate_product as $key => $val){
            $meta_desc = $val->category_description;
            $meta_title= $val->category_name;
            $meta_keywords= $val->meta_keywords;
            $url_canonical = $request->url();
        }

        $category_name = DB::table('tbl_category_product')->where('slug_category_product', $slug_category_product)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
    public function export_csv(){
        return Excel::download(new ExcelExports , 'category.xlsx');
    }
    public function import_csv(request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();

    }
}
