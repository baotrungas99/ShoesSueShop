@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>

			<div class="table-responsive cart_info"style="width:80%">
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
            @if(Session::get('cart')==true)
            <section id="do_action">
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
                                        echo '<li> Total Discount'.'<span>- $'.number_format($total_coupon).'</span>'.'</li>';
                                        @endphp

                                    <li>
                                       Current Total <span> ${{number_format($total-$total_coupon)}}</span>
                                    </li>
                                @elseif($cou['coupon_condition']==2)
                                <li> Coupon<span> ${{number_format($cou['coupon_number'])}}</span></li>

                                            @php
                                            $total_coupon = $total-$cou['coupon_number'];
                                            echo '<li>Total Discount'.'<span> - $'.number_format($cou['coupon_number']).'</span>'.'</li>';
                                            @endphp

                                        <li>
                                        Current Total<span> ${{number_format($total_coupon)}}</span>
                                        </li>
                                @endif
                            @endforeach
                        @endif


							<li>Eco Tax <span></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Finally Total<span></span></li>
						</ul>
                        @if(Session::get('cart')==true)
                        <ul>
                            <form method="post" action="{{url('/check-coupon')}}">
                                @csrf
                                <input type="text" class="form-control" placeholder="fill Coupon" name="coupon">
                                <input type="submit" class="btn btn-default check_out" value ="count coupon"name="check_coupon">
                                @if(Session::get('coupon')==true)
                                 <a class="btn btn-default check_out" style="" href="{{url('/unset-coupon')}}">Delete coupon</a>
                                @endif
                            </form>
                        </ul>
                            @if(session::get('customer_id')==true)
                                <center><a class="btn btn-default check_out"  href="{{url('/checkout')}}">Check Out</a></center>
                            @else
                                <center><a class="btn btn-default check_out"  href="{{url('/login-checkout')}}">Check Out</a></center>
                            @endif
                        @endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action--> @endif
	</div>
</section> <!--/#cart_items-->

@endsection
