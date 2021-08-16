@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Newest Features Items</h2>
        @foreach($all_product as $key => $product)
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
                            <form>
                                @csrf
                                <input type="hidden" class="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}" >
                                <input type="hidden" class="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}" >
                                <input type="hidden" class="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}" >
                                <input type="hidden" class="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}" >
                                <input type="hidden" class="cart_product_qty_{{$product->product_id}}" value="1" >

                                <a href="{{URL::to('detail-product/' . $product->product_slug)}}">
                                    <img src="{{URL::to('public/upload/product/' . $product->product_image)}}" alt="" />
                                        <h2>{{number_format($product->product_price)}}$</h2>
                                        <p>{{$product->product_name}}</p>
                                </a>
                                     <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </form>
							</div>
						</div>
						<div class="choose">
							<ul class="nav nav-pills nav-justified">
								<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
							</ul>
						</div>
					</div>
				</div>
        @endforeach

</div>
@endsection
