<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\SliderModel;
use DB;
use App\Models\Brand;
session_start();


class BrandProduct extends Controller
{
//funtion Admmin page
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function all_brand_product()
    {
        $this->AuthLogin();
        // $all_brand_product = array();
        // $manager_brand_product = array();
       // $all_brand_product = DB::table('tbl_brand_product')->get();
        //$all_brand_product = Brand::all();
        $all_brand_product = Brand::orderby('brand_id','desc')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);

        /*echo '<pre>';
        print_r($all_brand_product);
        echo '</pre>';*/
    }

    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $brand= new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->meta_keywords = $data['brand_keyword'];
        $brand->brand_description = $data['brand_product_description'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug']=$request->brand_slug;
        // $data['brand_description'] = $request->brand_product_description;
        // $data['brand_status'] = $request->brand_product_status;

        // DB::table('tbl_brand_product')->insert($data);
        session::put('message','Adding brand product successful');
        return Redirect::to('add-brand-product');
    }
    public function active_brand_product($brand_product_id) {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
        session::put('message','List brand prodcut active');
        return Redirect::to('all-brand-product');
    }
    public function unactive_brand_product($brand_product_id) {
        $this->AuthLogin();
         DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
        session::put('message','List brand prodcut unactive');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        //$edit_brand_product =Brand::find($brand_product_id);
        //dùng find thì bỏ @foreach và đổi biến thành $edit_brand_product-> nay có $edit_value-> của @foreach
        $edit_brand_product =Brand::where('brand_id',$brand_product_id)->get();

        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug']=$request->brand_product_slug;
        // $data['brand_description'] = $request->brand_product_description;
        // DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update($data);

        $data = $request->all();
        $brand= Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->meta_keywords = $data['brand_keyword'];
        $brand->brand_description = $data['brand_product_description'];
        //$brand->brand_status = $data['brand_product_status'];
        $brand->save();

        session::put('message','update brand product successful');
        return Redirect::to('all-brand-product');

    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
         DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->delete();
        session::put('message','delete brand product successful');
        return Redirect::to('all-brand-product');

    }
//end funtion Admin page
//funtion home page
    public function show_brand_home(Request $request,$brand_slug){
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
        ->where('tbl_brand_product.brand_slug',$brand_slug)->get();

            foreach($brand_product as $key => $val){
                $meta_desc = $val->brand_description;
                $meta_title= $val->brand_name;
                $meta_keywords= $val->meta_keywords;
                $url_canonical = $request->url();
            }

        $brand_name = DB::table('tbl_brand_product')->where('brand_slug', $brand_slug)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
}
