<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\SliderModel;
use Illuminate\Support\Facades\DB;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

     public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();


        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);

    }

   public function all_product()
    {
        $this->AuthLogin();

        // $all_category_product = array();
        // $manager_category_product = array();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);

        /*echo '<pre>';
        print_r($all_category_product);
        echo '</pre>';*/
    }


    public function save_product(Request $request)
    {
        $this->AuthLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        // $data['product_image'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_image_name));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
        Session::put('message','Adding product successful');
        return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Adding product successful');
        return Redirect::to('all-product');
    }
    public function active_product($product_id) {
        $this->AuthLogin();


        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
        Session::put('message','List prodcut active');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id) {
        $this->AuthLogin();

         DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
        Session::put('message',' prodcut unactive');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $this->AuthLogin();

        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id)
    {
        $this->AuthLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_image_name));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message','update product successful');
            return Redirect::to('all-product');
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message','update product successful');
        return Redirect::to('all-product');

    }
    public function delete_product($product_id){
        $this->AuthLogin();

         DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message','delete product successful');
        return Redirect::to('all-product');

    }
    //end function Admin page
    // function Home page
    public function details_product(Request $request,$product_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_slug',$product_slug)->get();
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }

        foreach($details_product as $key => $val){
            $meta_desc = $val->product_description;
            $meta_title= $val->product_name;
            $meta_keywords= $val->meta_keywords;
            $url_canonical = $request->url();
        }

            $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->wherenotin('tbl_product.product_slug',[$product_slug])->get();

        return view('pages.product.show_details')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
}

