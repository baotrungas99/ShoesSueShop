<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\LoginCustomer;
use App\Models\SliderModel;
use App\Models\CategoryPost;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(request $request){
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
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function add_customer(request $request){
        $data = array();
        $data['customer_name'] = $request->cus_name;
        $data['customer_email'] = $request->cus_email;
        $data['customer_password'] = md5($request->cus_pass);
        $data['customer_phone'] = $request->cus_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->cus_name);

        return Redirect::to('/checkout');
    }

    public function checkout(request $request){

        //seo
        $meta_desc = "checkout Cart";
        $meta_keywords = "checkout Ajax";
        $meta_title = "checkout Ajax";
        $url_canonical = $request->url();
        //--seo
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $province = Province::orderBy('matp','asc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('province',$province)->with('slider',$slider)->with('category_post',$category_post);
        // return view('/pages.checkout.show_checkout')->with(compact('meta_desc', 'meta_keywords','meta_title','url_canonical','slider','cate_product','brand_product','province'));
    }
    public function save_checkout_customer(request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);

        return Redirect::to('/payment');
    }
    public function payment(request $request){
        //seo
        $meta_desc = "Your payment";
        $meta_keywords = "payment Ajax";
        $meta_title = "payment Ajax";
        $url_canonical = $request->url();
        //--seo
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function order_place(request $request){
        //seo
        $meta_desc = "Your payment";
        $meta_keywords = "payment Ajax";
        $meta_title = "payment Ajax";
        $url_canonical = $request->url();
        //--seo
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();

        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'waiting';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'waiting';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order details
        $cartcontent =Cart::content();
        foreach ($cartcontent as $v_content) {
            // $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){
            echo 'ATM payment';
        }elseif($data['payment_method']==2){
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
        }else{
            echo 'debit card payment';
        }
        //return Redirect::to('/payment');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(request $request){
        //$data = $request->all();
        $data = $request->validate([
            //validation Laravel
            'email_account' => 'required',
            'password_account' => 'required',
        ]);
        // $email = $request->email_account;
        // $password = md5($request->password_account);
        $customer_email = $data['email_account'];
        $customer_password = $data['password_account'];
        $login = LoginCustomer::where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();
        // $result = DB::table('tbl_customers')->where('customer_email', $email)->Where('customer_password', $password)->First();
        if($login){
            Session::put('customer_id',$login->customer_id);
            session::put('message', 'Login successful, now you can checkout your cart');
            return Redirect::to('/checkout');
        }else{
            Session::put('message','Wrong username or password, please try again!');
            return Redirect::to('/login-checkout');
        }
    }

    //admin
    public function manage_orders(){
        $this->AuthLogin();
        // $all_category_product = array();
        // $manager_category_product = array();
        $all_orders = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.order.manage_orders')->with('all_orders',$all_orders);
        return view('admin_layout')->with('admin.order.manage_orders',$manager_order);
    }
    public function view_orders($order_id){
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();
        // echo '<pre>';
        // print_r($order_by_id);
        // echo '</pre>';
        $manager_order_by_id = view('admin.order.view_orders')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.order.view_orders',$manager_order_by_id);

    }

    public function selete_delivery_home(request $request) {
        $data = $request->all();
        if ($data['action']) {
            $output ='';
            if ($data['action'] == 'province') {
                $selete_district =  District::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                    $output.='<option >Select</option>';
                foreach ($selete_district as $key => $district) {
                    $output.= '<option value="'.$district->maqh.'">'.$district->name_quanhuyen.'</option>';
                }
            } else {
                $selete_wards =  Ward::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                    $output.='<option >Select</option>';
                foreach ($selete_wards as $key => $wards) {
                    $output.= '<option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function calculate_fee(request $request) {
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if($feeship) {
                $count_feeship = $feeship->count();
                if($count_feeship>0) {
                    foreach ($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                    Session::put('fee',2);
                    Session::save();
                }
            }

            return redirect()->back();
        }
    }
    public function del_fee(request $request){
        Session::forget('fee');
        return redirect()->back();
    }
    public function confirmed_order(request $request){
        $data = $request->all();

        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id; // get shipping id

        $checkout_code = substr(md5(microtime()),rand(0,26),5); // get random checkout code

        $order = new Order();
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $order->created_at = now();
        $order->save();

        if(session::get('cart')){
            foreach(session::get('cart') as $key =>$cart){

                $order_details = new OrderDetails();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =   $data['order_coupon'];
                $order_details->product_feeship = $data['order_feeship'];
                $order_details->save();
            }
        }
        session::forget('coupon');
        session::forget('fee');
        session::forget('cart');
    }
}
