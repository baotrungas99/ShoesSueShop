@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">check out</li>
				</ol>
			</div><!--/breadcrums-->
            
			<!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
                <div class="col-sm-12 clearfix">
                                    <div class="table-responsive cart_info"style="width:83%">
                            @if(session()->has('message'))
                                    <div  class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                            <form action="{{url('/update-cart')}}" method="post">
                                @csrf
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Item</td>
                                            <td class="name">Name</td>
                                            <td class="description">Description</td>
                                            <td class="price">Price</td>
                                            <td class="quantity">Quantity</td>
                                            <td class="total">SubTotal</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(Session::get('cart')==true)
                                    @php
                                            $total = 0;
                                        @endphp
                                    @foreach(Session::get('cart') as $key => $val)
                                        @php
                                            $subtotal = $val['product_price']*$val['product_qty'];
                                            $total+=$subtotal;
                                        @endphp
                                        <tr>
                                            <td class="cart_product">
                                                <a href=""><img src="{{asset('public/upload/product/' . $val['product_image'])}}" alt="{{$val['product_name']}}" width="50"></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href=""></a></h4>
                                                <p>{{$val['product_name']}}</p>
                                            </td>
                                            <td class="cart_price">
                                                <p>$ {{number_format($val['product_price'])}}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$val['session_id']}}]" value="{{$val['product_qty']}}">
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">
                                                $ {{number_format($subtotal)}}
                                                </p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" href="{{url('/delete-product-cart/'.$val['session_id'])}}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                    <td> <input type="submit" value="update" name="update_qty"class="btn btn-default check_out"></td>
                                <td> <a class="btn btn-default check_out" href="{{url('/del-all-product-cart')}}">Delete all product</a></td>
                                    </tr>
                                    @else
                                    <tr>
                                            <td colspan="6"><center>
                                                @php
                                                echo 'Please add product to cart';
                                                @endphp
                                            </center></td>
                                    </tr>
                                    @endif
                                    </tbody>
                                    </form>
                                </table>
                            </div>
                            </div>
                    </div>
				</div>
			</div>
                @if(Session::get('cart')==true)

                        <div class="container">
                            <div class="breadcrumbs">
                                <div class="" style="width:80%">
                                    <div class="total_area">
                                        <ul>
                                            <li>Total <span>$ {{number_format($total)}}</span></li>
                                        @if(Session::get('coupon'))
                                            @foreach(Session::get('coupon') as $key => $cou)
                                                @if($cou['coupon_condition']==1)
                                                <li>Coupon<span> {{$cou['coupon_number']}} %</span></li>
                                                        @php
                                                        $total_coupon = ($total*$cou['coupon_number'])/100;
                                                        echo '<li> Total Discount'.'<span>- $'.number_format($total-$total_coupon).'</span>'.'</li>';
													$total_after_coupon = $total-$total_coupon;
												@endphp
                                                @elseif($cou['coupon_condition']==2)
                                                <li> Coupon<span> ${{number_format($cou['coupon_number'])}}</span></li>
                                                            @php
                                                            $total_coupon = $total-$cou['coupon_number'];
                                                            echo '<li>Total Discount'.'<span> - $'.number_format($total-$total_coupon).'</span>'.'</li>';
															$total_after_coupon = $total_coupon;
														@endphp
                                                @endif
                                            @endforeach
                                        @endif
                                            <!-- <li>Eco Tax <span></span></li> -->
                                        @if(session::get('fee'))
                                            <li>Shipping Cost <span>$ {{number_format(session::get('fee'))}}<a class="del-fee" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a></span></li>
                                            <?php $total_after_fee = $total + Session::get('fee'); ?>
                                        @endif
                                        <li>Finally Total<span>
                                        <?php //create total
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo '$'.number_format($total_after);
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo '$'.number_format($total_after);
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo '$'.number_format($total_after);
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo '$'.number_format($total_after);
											}
										?>
                                        </span></li>
                                        </ul>
                                        @if(Session::get('cart')==true)
                                        <ul>
                                            <form method="post" action="{{url('/check-coupon')}}">
                                                @csrf
                                                <input type="text" class="form-control" placeholder="fill Coupon" name="coupon">
                                                <input type="submit" class="btn btn-default check_out" value ="count coupon"name="check_coupon">
                                                @if(Session::get('coupon')==true)
                                                <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Delete coupon</a>
                                                @endif
                                            </form>
                                        </ul>
                                            <!-- <center><a class="btn btn-default check_out"  href="">Check Out</a></center> -->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form  method="post">
                                    @csrf
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email*"required>
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Name"required>
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Phone Number *"required>
									<input type="text" name="shipping_address" class="shipping_address"placeholder="Address"required>
                                    <textarea name="shipping_notes" class="shipping_notes" placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea>
                                    @if(session::get('fee'))
                                        <input type="hidden" name="order_feeship" class="order_feeship" value="{{ session::get('fee') }}"/>
                                    @else
                                        <input type="hidden" name="order_feeship" class="order_feeship"value='1'/>
                                    @endif
                                    @if(session::get('coupon'))
                                        @foreach(session::get('coupon') as $key =>$coupon)
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{$coupon['coupon_code']}}"/>
                                        @endforeach
                                    @else
                                            <input type="hidden" name="order_coupon" class="order_coupon"value="no">
                                    @endif
                                    @if(session::get('cart'))
                                        @foreach(session::get('cart') as $key => $ca)
                                        <input type="hidden" name="section_id_cart" class="section_id_cart"value="{{$ca['session_id']}}">
                                        @endforeach
                                        @else
                                        <input type="hidden" name="section_id_cart" class="section_id_cart">
                                    @endif
                                        <div class="form">
                                            <label for="exampleInputPassword1">Choose Payment options</label>
                                                <select name="payment_selete" id="payment_selete" class="form-control input-sm m-bot15 payment_selete">
                                                    <option value="0">Direct Bank Transfer</option>
                                                    <option value="1">Hand Cash Payment</option>
                                                    <option value="2">Paypal</option>
                                            </select>
                                        </div>
                                        <input type="button" value="Confirmed Order" name="send_order"class="btn btn-primary btn-sm send_order">
								</form>
                    </div>
                    <div class="col-sm-6 clearfix">
                                <form >
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Choose Province</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                        <option value="">Choose Province City</option>
                                        @foreach($province as $key => $value)
                                        <option value="{{$value->matp}}">{{$value->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Choose District</label>
                                    <select name="district" id="district" class="form-control input-sm m-bot15 choose district">
                                    <option value="">Choose District</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Choose Wards</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">Choose Wards</option>
                                    </select>
                                </div>

                                <input type="button" value="Calculate feeship" name="cal_delivery" class="btn btn-primary btn-sm cal_deli">
                                </form>
						</div>
					</div>
		</div>

	</section> <!--/#cart_items-->
@endsection
