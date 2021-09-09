<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Cart;
use App\Models\SliderModel;
use App\Models\Coupon;
use App\Models\CategoryPost;
session_start();

class CartController extends Controller
{
    // public function save_cart(Request $request){

    //     $productId = $request->productid_hidden;
    //     $quantity = $request->qty;

    //     $productInfo = DB::table('tbl_product')->where('product_id',$productId)->first();

    //     //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    //     // Cart::destroy();

    //     $data['id'] = $productInfo->product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $productInfo->product_name;
    //     $data['price'] = $productInfo->product_price;
    //     $data['weight'] = $productInfo->product_price;
    //     $data['options']['image'] = $productInfo->product_image;
    //     Cart::add($data);

    //     return redirect::to('/show-cart');

    // }
    // public function show_cart(request $request){
    //     //seo
    //     $meta_desc = "Your Cart";
    //     $meta_keywords = "Cart ";
    //     $meta_title = "Cart ";
    //     $url_canonical = $request->url();
    //     //--seo
    //     $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();

    //     $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    //     $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

    //     return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider);
    // }
    // public function delete_cart($rowID){
    //     Cart::update($rowID,0);
    //     return redirect::to('/show-cart');
    // }
    // public function update_cart_qty(Request $request){
    //     $rowId = $request->rowId_cart;
    //     $qty = $request->cart_quantity;
    //     Cart::update($rowId, $qty);
    //     return redirect::to('/show-cart');
    // }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }

        Session::save();

    }
    public function delete_product_cart($session_id){
        $cart = Session::get('cart');
        //echo '<pre>';
        //print_r($cart);
        //echo '</pre>';
        if ($cart==true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id']==$session_id) {
                    unset($cart[$key]);
                }
            }
            session::put('cart', $cart);
            return redirect()->back()->with('message', 'Delete product successfully');
        }else{
            return redirect()->back()->with('message','Delete product fail');
        }
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key =>$qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty']=$qty;
                    }
                }
            }
            session::put('cart',$cart);
            return redirect()->back()->with('message', 'Update quantity successfully');
        }else{
            return redirect()->back()->with('message','Update quantity fail');
        }
    }
     public function cart_ajax(Request $request){
        //seo
        $meta_desc = "Your Cart";
        $meta_keywords = "Cart Ajax";
        $meta_title = "Cart Ajax";
        $url_canonical = $request->url();
        //--seo
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.cart.show_cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
    public function del_all_product_cart(){
        $cart =session::get('cart');
        if($cart==true){
            session::forget('cart');
            session::forget('coupon');
            return redirect()->back()->with('message', 'Delete all successfully');
        }
    }
    public function check_coupon(request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('counpon');
                if($coupon_session==true){
                    $is_avaiable= 0;
                    if($is_avaiable==0){
                        $cou[]=array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        session::put('coupon', $cou);
                    }
                }else{
                    $cou[]=array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    session::put('coupon', $cou);
                }
                session::save();
                return redirect()->back()->with('message', 'add coupon successfully');
            }
        }else{
            return redirect()->back()->with('error', 'Wrong coupon or This coupon does not exsit');
        }
    }
}
