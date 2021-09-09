<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Feeship;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\SliderModel;
use Auth;
use Illuminate\Support\Facades\Redirect;
use PDF;
session_start();
class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function update_qty(request $request){
        $this->AuthLogin();
        $data = $request->all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }
    public function update_order_qty(request $request){
        $this->AuthLogin();
        $data = $request->all();
        //update order
        $order = Order::find($data['order_id']);
        $order->order_status=$data['order_status'];
        $order->save();
        //
        if($order->order_status==2){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_qty_sold = $product->product_qty_sold;
                foreach($data['quantity'] as $key2 => $qty){
                    // $key chay tu 0 tuong ứng với chuỗi truyền vào bên ajax
                    //ví dụ: lấy từ ajax quantity[4,5,6,7], key tương ứng $key[0,1,2,3]
                    //$key2: 0 => qty[4]; $key2: 3 => qty[7];
                    if($key==$key2){
                        $pro_remain=$product_quantity-$qty;
                        $product->product_quantity=$pro_remain;
                        $product->product_qty_sold=$product_qty_sold+$qty;
                        $product->save();
                    }
                }
            }
        }elseif($order->order_status!=2 && $order->order_status!=3){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_qty_sold = $product->product_qty_sold;
                foreach($data['quantity'] as $key2 => $qty){
                    if($key==$key2){
                        $pro_remain=$product_quantity+$qty;
                        $product->product_quantity=$pro_remain;
                        $product->product_qty_sold=$product_qty_sold-$qty;
                        $product->save();
                    }
                }
            }
        }
    }
    public function manage_orders(){
        $this->AuthLogin();
        $order = Order::orderby('created_at', 'desc')->get();
        return view('admin.order.manage_orders')->with(compact('order'));
    }
    public function view_orders($order_code){
        $this->AuthLogin();
        // $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details_product as $key => $ord_deta){
            $product_coupon = $ord_deta->product_coupon;
            $product_feeship = $ord_deta->product_feeship;
        }
        if($product_coupon!='no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            // echo $coupon->coupon_number;
            $coupon_condition = $coupon->coupon_condition;//get the coupon condition
            $coupon_number = $coupon->coupon_number;// get the coupon number for calculating the price
        }else{
            $coupon_condition=2;
            $coupon_number=0;
        }

        return view('admin.order.view_orders')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
    }
    public function print_orders($checkout_code){
        $this->AuthLogin();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $this->AuthLogin();
        // return $checkout_code;
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::orderby('created_at', 'desc')->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

        foreach ($order_details_product as $key => $ord_deta){
            $product_coupon = $ord_deta->product_coupon;
            $product_feeship = $ord_deta->product_feeship;
        }
        if($product_coupon!='no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            // echo $coupon->coupon_number;
            $coupon_condition = $coupon->coupon_condition;//get the coupon condition
            $coupon_number = $coupon->coupon_number;// get the coupon number for calculating the price
            if($coupon_condition=='1'){
                $coupon_echo = $coupon_number.'%';
            }elseif($coupon_condition=='2'){
                $coupon_echo = '$'.number_format($coupon_number);
            }
        }else{
            $coupon_condition=2;
            $coupon_number=0;
            $coupon_echo='$ 0';
        }
        $output = '';
        $output .= '<style>
                    body { font-family:  arial;}
                    .table-styling{
                        border: 1px solid #000;
                    }
                    .table-styling tr td{
                        border: 1px solid #000;
                    }
        </style>
        <h1><center>CHRISBO COMPANY</center></h1>
        <h4><center>Doc lap - Tu do - Hanh phuc</center></h4>
        <h3><center>RETAIL BILL</center></h3>
        <p>Customer</p>
        <table class="table table-styling ">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Customer Email</th>
                        </tr>
                        </thead>
                        <tbody>';
        $output.='
                            <tr>
                                <td>'.$customer->customer_name.'</td>
                                <td>'.$customer->customer_phone.'</td>
                                <td>'.$customer->customer_email.'</td>
                            </tr>';
        $output.='
                        </tbody>
                    </table>
        <p>Shipping</p>
        <table class="table table-styling ">
                        <thead>
                        <tr>
                            <th>Customer Recived</th>
                            <th>Customer Phone</th>
                            <th>Customer Email</th>
                            <th>Customer Andress</th>
                            <th>Customer note</th>
                        </tr>
                        </thead>
                        <tbody>';
        $output.='
                            <tr>
                                <td>'.$shipping->shipping_name.'</td>
                                <td>'.$shipping->shipping_phone.'</td>
                                <td>'.$shipping->shipping_email.'</td>
                                <td>'.$shipping->shipping_address.'</td>
                                <td>'.$shipping->shipping_note.'</td>
                            </tr>';
        $output.='
                        </tbody>
                    </table>
        <p>Order</p>
        <table class="table table-styling ">
                        <thead>
                        <tr>
                            <th>Products name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Shipping Fee</th>
                            <th>Coupon</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>';

                        $total = 0;

                        foreach ($order_details_product as $key => $pro) {
                            $subtotal=$pro->product_sales_quantity*$pro->product_price;
                            $total+=$subtotal;
                            if($pro->product_coupon!='no'){
                                $product_coupon=$pro->product_coupon;
                            }else{
                                $product_coupon='no coupon';
                            }
        $output.='
                            <tr>
                                <td>'.$pro->product_name.'</td>
                                <td>'.$pro->product_sales_quantity.'</td>
                                <td> $ '.number_format($pro->product_price).'</td>
                                <td> $ '.number_format($pro->product_feeship).'</td>
                                <td>'.$pro->product_coupon.'</td>
                                <td> $ '.number_format($subtotal).'</td>
                            </tr>';
                        }
                        if($coupon_condition == 1) {
                            $total_add_coupon = ($total*$coupon_number)/100;
                            $total_coupon = $total- $total_add_coupon +$product_feeship;
                        }else{
                            $total_coupon= $total-$coupon_number + $product_feeship;
                        }
        $output.='
                    <tr>
                        <td colspan="2">
                            <h3>Discount:-'.$coupon_echo.' </h3>
                            <h3>Shipping fee: $ '.number_format($pro->product_feeship).' </h3>
                            <h3>Total: $ '.number_format($total_coupon).' </h3>
                        </td>
                    </tr>
        ';
        $output.='
                        </tbody>
                    </table>
                    <p>Sign</p>
        <table>
                        <thead>
                        <tr>
                            <th width="200px">Shop owner</th>
                            <th width="700px">Customer ricieved</th>

                        </tr>
                        </thead>
                        <tbody>';
        $output.='
                        </tbody>
                    </table>';
        return $output;
    }
}
