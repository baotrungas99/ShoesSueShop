<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- seo -->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="" />
    <meta name="author" content="">

    {{--   <meta property="og:image" content="{{$image_og}}" />
      <meta property="og:site_name" content="http://localhost/webbanhangLAVAREL/shopbanhang" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" /> --}}
    <!-- seo -->

    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +84 36 96 31 514</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Chrissueshop@chrissuesop.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/homepage')}}"><img src="{{asset('public/frontend/images/chrisbologoresize.jpg')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>

							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>

                                <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if ($customer_id!=NULL && $shipping_id==Null) {
                                    ?>

                               <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>

                                <?php
                                }elseif($customer_id!=NULL && $shipping_id!=Null){
                                ?>

                                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>

                            <?php
                                }else{
                            ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <?php
                                }
                            ?>

								<li><a href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

                            <?php
                                $customer_id = Session::get('customer_id');
                                if ($customer_id!=NULL) {
                                    ?>
                                <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Logout</a></li>
                                <?php
                                }else{?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Login</a></li>
                            <?php
                                }
                            ?>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/homepage')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>

                                    <ul role="menu" class="sub-menu">
                                    @foreach($category as $key => $cate)
                                        @if($cate->category_status==0)
                                        <li><a href="{{url('/category-product/'.$cate->slug_category_product)}}">
                                        {{$cate->category_name}}</a></li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </li>

								<li class="dropdown"><a href="#">News<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($category_post as $key => $cate_post)
                                        @if($cate_post->cate_post_status==0)
                                        <li><a href="{{url('/category-post/'.$cate_post->cate_post_slug)}}">
                                        {{$cate_post->cate_post_name}}</a></li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </li>
								<li><a href="{{URL::to('/show-cart-ajax')}}">Cart</a></li>
								<li><a href="{{url('/contact')}}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
                        <form action="{{URL::to('/search')}}" method="post">
                        {{csrf_field()}}
                            <div class="search_box pull-right">
							    <input type="text" name="keyword_submit" placeholder="Search"/>
                                <input type="submit" name="search_items" style="margin-top: 0; color:black;height: 33px;font-weight: 300; width: 80px;" class="btn btn-primary btn sm" value="Search"/>
						    </div>
                        </form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
                        @php $i=0; @endphp
						<div class="carousel-inner">
                            @foreach ($slider as $key => $slide)
                            @php $i++; @endphp
							<div class="item {{$i==1 ? 'active' : ''}}">
								<div class="col-sm-6">
									<h1><span>CHRISBO</span>-SHOPPER</h1>
									<h2>SUE SHOES E-Commerce</h2>
									<!-- <p>{{$slide->slider_desc}} </p> -->
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
                                    <img src="{{asset('public/upload/slider/'.$slide->slider_image)}}"class="image img-responsive" alt="{{$slide->slider_desc}}">
								</div>
							</div>@endforeach
						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($category as $key => $cate)
							    <div class="panel panel-default">
                                    @if($cate->category_parent==0)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="{{url('/category-product/'.$cate->slug_category_product)}}">
                                                <span class="badge pull-right"><i data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}" class="fa fa-plus"></i></span>
                                                {{$cate->category_name}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                @foreach($category as $key => $cate_sub)
                                                    @if($cate_sub->category_id==$cate->category_parent)
                                                    <li><a href="{{url('/category-product/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}} </a></li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
							    </div>
                            @endforeach
						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
                                @foreach($brand as $key => $br)
								    <ul class="nav nav-pills nav-stacked">

									    <li><a href="{{URL::to('/brand-product/'.$br->brand_slug)}}"> <span class="pull-right"></span>{{$br->brand_name}}</a></li>

								    </ul>
                                @endforeach
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<!-- <h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div> -->
						</div><!--/price-range-->

						<div class="shipping text-center"><!--shipping-->
							<!-- <img src="{{('public/frontend/images/shipping.jpg')}}" alt="" /> -->
						</div><!--/shipping-->
					</div>
				</div>

				<div class="col-sm-9 padding-right">


                @yield('content')


				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>ChrisBo</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/chrisbologo.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Comming soon...</p>
								<h2>9 SEP 2021</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/chrisbologo.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Comming soon...</p>
								<h2>9 SEP 2021</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/chrisbologo.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Comming soon...</p>
								<h2>9 SEP 2021</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/chrisbologo.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Comming soon...</p>
								<h2>9 SEP 2021</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{asset('public/frontend/images/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2021 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Nguyen Bao Trung</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->

    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="SgAx3p8M"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script type="text/javascript">
        $(document).ready(function(){
           $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(){
                        swal("Product adding successfully", {
                                buttons: {
                                    cancel: "Continue View",
                                    catch: { text: "Move to cart", value: "catch",},
                                },
                                }).then((value) => {
                                        switch (value) {
                                            case "catch":
                                            swal("Gotcha!", "Move to Cart", "success",).then(function() {
                                            window.location.href = "{{url('/show-cart-ajax')}}";
                                            });
                                            // .then(function(){
                                            //     url::to('/show-cart-ajax');
                                            // });
                                            break;
                                            default:
                                            swal("Stay Successfully");
                                        }
                                    });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change',function(){
                var action = $(this).attr('id');//get id of class
                var ma_id = $(this).val(); // get value of option in choose province
                var _token = $('input[name="_token"]').val(); // send form token
                var result = '';
                if(action == 'province'){
                    result ='district';
                }else{
                    result ='wards'
                }
                $.ajax({
                    url: '{{url('/selete-delivery-home')}}',
                    method: 'POST',
                    data: {action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }

                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.cal_deli').click(function(){
                var matp =  $('.province').val();
                var maqh =  $('.district').val();
                var xaid =  $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp=='', maqh=='' ,xaid==''){
                    swal({
                        title: "Please select your recived place",
                        icon: "warning"
                    });
                }else{
                    $.ajax({
                    url: '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data: {matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                        location.reload();  //reload the page to show fee ship
                    }
                });
                }
            })
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
           $('.send_order').click(function(){
                    var shipping_email = $('.shipping_email').val();
                    var shipping_name = $('.shipping_name').val();
                    var shipping_phone = $('.shipping_phone').val();
                    var shipping_address = $('.shipping_address').val();
                    var shipping_notes = $('.shipping_notes').val();
                    var order_feeship = $('.order_feeship').val();
                    var order_coupon = $('.order_coupon').val();
                    var shipping_method = $('.payment_selete').val();
                    var _token = $('input[name="_token"]').val();
                    var session_cart_id = $('.section_id_cart').val(); //validate order
        if(session_cart_id=='',shipping_email=='', shipping_name=='' , shipping_phone=='', shipping_address==''){
            swal({
                title: "Please fill your information and add products to cart to continue order",
                icon: "warning"
            });
        }else{
            swal({
                title: "Do you confirm your order?",
                text: "Your order will be sent, you cannot recieved your order!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then(function(confirmed) {
                if (confirmed) {
                        $.ajax({
                            url: '{{url('/confirmed-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_notes:shipping_notes,_token:_token,order_feeship:order_feeship,order_coupon:order_coupon,shipping_method:shipping_method},
                                success:function(){
                                    swal("Poof! Your order is confirmed!", {
                                    icon: "success",
                                    text: "Your order comming soon!",
                                    // buttons:true,
                                    });
                                }
                        });
                        $.ajax({
                            url:'{{url('/send-mail')}}',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_notes:shipping_notes,_token:_token,order_feeship:order_feeship,order_coupon:order_coupon,shipping_method:shipping_method,session_cart_id=session_cart_id},
                            method:'get',
                            success:function(){
                                swal("Poof! Your order details is sent to your email. please check your email!", {
                                    icon: "success",
                                    text: "Your order comming soon!",
                                    });
                            }
                        });
                        window.setTimeout(function(){
                            location.reload();
                        },7000);// reset timeout ajax request
                } else {
                    swal("Pleas complete your order to continue...!");
                }
                });
        }

            });
        });
</script>
</body>
</html>
