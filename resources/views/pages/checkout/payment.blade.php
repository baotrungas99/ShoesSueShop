@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">payment cart</li>
				</ol>


			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

            <div class="table-responsive cart_info"style="width:80%">
                <?php
                $cartcontent =Cart::content();
                // echo'<pre>';
                // print_r($cartcontent);
                // echo '</pre>';
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($cartcontent as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/' . $v_content->options->image)}}" alt="" width="50"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>${{number_format($v_content->price)}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
                                    <form action="{{URL::to('/update-cart-qty')}}" method="post">
                                        {{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">
                                    <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"class="form-control">
									<input type="submit" value="update" name="update_qty"class="btn btn-default btn-sm">
                                    </form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                <?php
                                        $subtotal = $v_content->price* $v_content->qty;
                                        echo "$".number_format($subtotal);
                                ?>
                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach
					</tbody>
				</table>
			</div>



            <form method="post" action="{{URL::to('/order-place')}}">
                {{csrf_field()}}
                <div class="payment-options">
                    <h4>Choose payment method</h4>
                     <span>
						<label><input name="payment_option" type="checkbox" value="1"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input name="payment_option" type="checkbox" value="2">Payment cash</label>
					</span>
                    <span>
						<label><input name="payment_option" type="checkbox" value="3">Payment Debit card</label>
                    <input type="submit" value="Order" name="send_order_place"class="btn btn-primary btn-sm">
					</span>
                </div>
            </form>

		</div>
	</section> <!--/#cart_items-->

@endsection
