<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use League\CommonMark\Extension\Table\Table;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CouponController extends Controller
{
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');
    }
    public function insert_coupon_code(request $request){
        $data = $request->all();
        $coupon = new Coupon();

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->save();

        session::put('message','Adding coupon code successful');
        return Redirect::to('insert-coupon');
    }
    public function list_coupon()
    {
        // $this->AuthLogin();


        $all_coupon = Coupon::orderby('coupon_id','desc')->get();
        // $manage_coupon = view('admin.coupon.list_coupon')->with('all_coupon',$all_coupon);
        return view('admin.coupon.list_coupon')->with(compact('all_coupon'));

    }
    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
         $coupon->delete();
        session::put('message','Delete coupon code successful');
        return Redirect::to('list-coupon');
    }
    public function unset_coupon(){
        $coupon =session::get('coupon');
        if($coupon==true){
            session::forget('coupon');
            return redirect()->back()->with('message', 'Delete Coupon successfully');
        }
    }
}
