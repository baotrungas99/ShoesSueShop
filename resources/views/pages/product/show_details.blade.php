@extends('layout')
@section('content')
@foreach ($details as $key => $details)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('public/upload/product/' . $details->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">

								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
									</div>
								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="public/frontend/image//new.jpg" class="newarrival" alt="" />
								<h2>{{$details->product_name}}</h2>
								<p>Web ID: {{$details->product_id}}</p>
								<img src="public/frontend/image//rating.png" alt="" />
                                <form action="{{URL::to('/save-cart')}}" method="post">
                                    {{csrf_field ()}}
                                <input type="hidden" class="cart_product_id_{{$details->product_id}}" value="{{$details->product_id}}" >
                                <input type="hidden" class="cart_product_name_{{$details->product_id}}" value="{{$details->product_name}}" >
                                <input type="hidden" class="cart_product_image_{{$details->product_id}}" value="{{$details->product_image}}" >
                                <input type="hidden" class="cart_product_price_{{$details->product_id}}" value="{{$details->product_price}}" >
                                    <span>
                                        <span>US ${{number_format($details->product_price)}}</span>
                                        <label>Quantity:</label>
                                        <input name="qty" type="number" class="cart_product_qty_{{$details->product_id}}" min="1" value="1" />
                                        <input name="productid_hidden" type="hidden" value="{{$details->product_id}}" />

                                    </span>
                                    <button  type="button" class="btn btn-default add-to-cart col-sm-8" data-id_product="{{$details->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </form><br><br><br>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b>{{$details->brand_name}}</p>
                                <p><b>category:</b>{{$details->category_name}}</p>
								<a href=""><img src="public/frontend/image//share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Description</a></li>
								<li><a href="#content" data-toggle="tab">Details</a></li>
								<li><a href="#reviews" data-toggle="tab">Reviews</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
                            <p>{!!$details->product_description!!}</p>
							</div>
							<div class="tab-pane fade" id="content" >
                            <p>{!!$details->product_content!!}</p>
							</div>
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>

									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="public/frontend/image//rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>

						</div>
					</div><!--/category-tab-->
@endforeach
<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>
<div class="fb-share-button" data-href="http://localhost/webbanhangLAVAREL/shopbanhang/homepage" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
            <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">related items</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
                                @foreach($relate as $key =>$related)
								<div class="item active">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													
													<form>
                                @csrf
                                <input type="hidden" class="cart_product_id_{{$related->product_id}}" value="{{$related->product_id}}" >
                                <input type="hidden" class="cart_product_name_{{$related->product_id}}" value="{{$related->product_name}}" >
                                <input type="hidden" class="cart_product_image_{{$related->product_id}}" value="{{$related->product_image}}" >
                                <input type="hidden" class="cart_product_price_{{$related->product_id}}" value="{{$related->product_price}}" >
                                <input type="hidden" class="cart_product_qty_{{$related->product_id}}" value="1" >

                                <a href="{{URL::to('detail-product/' . $related->product_slug)}}">
                                    <img src="{{URL::to('public/upload/product/' . $related->product_image)}}" alt="" />
                                        <h2>{{number_format($related->product_price)}}$</h2>
                                        <p>{{$related->product_name}}</p>
                                </a>
                                     <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$related->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </form>
												</div>
											</div>
										</div>
									</div>
								</div>
                                @endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
						</div>
					</div><!--/recommended_items-->

 @endsection
