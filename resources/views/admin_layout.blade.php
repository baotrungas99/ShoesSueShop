<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="{{asset('public/backend/ck/ckeditor/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
//using ckeditor though class="ckeditor form-control"
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<!-- form validation -->
<script type="text/javascript">
$("#validatetForm").validate();
</script>
<script src="{{asset('public/backend/js/formValidation.min.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<!--
 -->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/adminlogo.jpg')}}">
                <span class="username">

                <?php
	                $name = Auth::user()->admin_name;
	                if($name){
		                    echo $name;
	                }
	            ?>

                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>@hasrole(['admin','user'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-phone-square"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/add-slider')}}">Add banner</a></li>
						<li><a href="{{URL::to('/manage-slider')}}">Manage Banner</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-phone-square"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-orders')}}">Manage orders</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-phone-square"></i>
                        <span>Delivery</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url('/delivery')}}">Manage Delivery</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Coupon</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url('/insert-coupon')}}">Manage Coupon</a></li>
                        <li><a href="{{url('/list-coupon')}}">List Coupon</a></li>

                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Productions category</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Add category Production</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Category Production list</a></li>

                    </ul>
                </li>

                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Productions Brand</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Add Brand production</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Brand Production list</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Productions</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Add production</a></li>
						<li><a href="{{URL::to('/all-product')}}">Production list</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Manage Category Post News</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-post')}}">Add category post news</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Category post news list</a></li>

                    </ul>
                </li>
                @endhasrole
                @hasrole(['admin','user','author'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Manage Post News</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Add post news</a></li>
						<li><a href="{{URL::to('/all-post')}}">Post news list</a></li>
                    </ul>
                </li>
                @endhasrole
                @hasrole('admin')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                         <li><a href="{{URL::to('/add-users')}}">Add user</a></li>
                        <li><a href="{{URL::to('/users')}}">Manage user</a></li>
                    </ul>
                </li>
                @endhasrole
                @impersonate
                <li>
                    <a href="{{URL::to('/impersonate-destroy')}}">
                        <i class="fa fa-backward"></i>
                        <span>Return back</span>
                    </a>
                </li>
                @endimpersonate
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">

		@yield('admin_content')

</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2021 Visitors. All rights reserved | Design by <a href="">Trung Dep Trai</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- script take Dictric and wards -->
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+ order_product_id).val();
        var order_code= $('.order_code').val();
        var _token= $('input[name="_token"]').val();
        $.ajax({
                    url: '{{url('/update-qty')}}',
                    method: 'POST',
                    data: {_token:_token,order_qty:order_qty, order_code:order_code,order_product_id:order_product_id},
                    success:function(data){
                        alert('change quantity order successfully')
                        location.reload();
                    }
                });
    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        // alert('Order Details have been updated.');
        var order_status = $(this).val();
        var order_id = $(this).children(':selected').attr('id');
        var _token= $('input[name="_token"]').val();
        // get quantity
        quantity =[];
        $('input[name="product_sales_quantity"]').each(function(){
            quantity.push($(this).val());
        });
        //get product_id
        order_product_id=[];
        $('input[name="order_product_id"]').each(function(){
            order_product_id.push($(this).val());
        });
        // alert(order_product_id);
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //quantity order
            var order_qty = $('.order_qty_'+ order_product_id[i]).val();
            //quantity in store
            var order_qty_storage = $('.order_qty_storage_'+ order_product_id[i]).val();
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j=j+1;
                if(j==1){
                    alert('out of stock quantity in store');
                }
                $('.color_qty_'+order_product_id[i]).css('background','rgb(186 20 20)');
            }
        }
        if(j==0){
            $.ajax({
                        url: '{{url('/update-order-qty')}}',
                        method: 'POST',
                        data: {_token:_token,order_status:order_status, quantity:quantity, order_id:order_id,order_product_id:order_product_id},
                        success:function(data){
                            alert('Manage order successfully')
                            location.reload();
                        }
                    });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
            fetch_delivery();// load function
            function fetch_delivery(){
                var _token = $('input[name="_token"]').val(); // send form token
                $.ajax({
                    url: '{{url('/selete-feeship')}}',
                    method: 'POST',
                    data: {_token:_token },
                    success:function(data){
                        $('#load_delivery').html(data);
                    }
                });
            }
          $('.add-delivery').click(function(){
                var province = $('.province').val();
                var district = $('.district').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val(); // send form token
                // alert(province);
                // alert(district);
                // alert(wards);
                // alert(fee_ship);
                // alert(_token);
                $.ajax({
                    url: '{{url('/insert-delivery')}}',
                    method: 'POST',
                    data: { province:province, district:district, wards:wards, fee_ship:fee_ship,_token:_token },
                    success:function(data){
                        alert('add fee ship successfully');
                    }
                });
          });
            $('.choose').on('change',function(){
                var action = $(this).attr('id');//get id of class
                var ma_id = $(this).val(); // get value of option in choose province
                var _token = $('input[name="_token"]').val(); // send form token
                var result = '';
                // alert(action);
                // alert(matp);
                // alert(_token);
                // alert(result);
                if(action == 'province'){
                    result ='district';
                }else{
                    result ='wards'
                }
                $.ajax({
                    url: '{{url('/selete-delivery')}}',
                    method: 'POST',
                    data: {action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }

                });
            });
            $(document).on('blur','.fee_feeship_edit',function(){
               // alert('test blur'); // blur - when click anywhere it show an alert
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val(); // send form token
                // alert(feeship_id);
                // alert(fee_value);
                $.ajax({
                    url: '{{url('/update-feeship')}}',
                    method: 'POST',
                    data: {feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                    success:function(data){
                        fetch_delivery();
                    }

                });
            });
    });
</script>
<!-- morris JavaScript -->
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });

	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}

		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},

			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});


	});
	</script>
    <script type="text/javascript">

 function ChangeToSlug()
     {
         var slug;
         //Lấy text từ thẻ input title
         slug = document.getElementById("slug").value;
         slug = slug.toLowerCase();
         //Đổi ký tự có dấu thành không dấu
             slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
             slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
             slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
             slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
             slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
             slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
             slug = slug.replace(/đ/gi, 'd');
             //Xóa các ký tự đặt biệt
             slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
             //Đổi khoảng trắng thành ký tự gạch ngang
             slug = slug.replace(/ /gi, "-");
             //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
             //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
             slug = slug.replace(/\-\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-/gi, '-');
             slug = slug.replace(/\-\-/gi, '-');
             //Xóa các ký tự gạch ngang ở đầu và cuối
             slug = '@' + slug + '@';
             slug = slug.replace(/\@\-|\-\@|\@/gi, '');
             //In slug ra textbox có id “slug”
         document.getElementById('convert_slug').value = slug;
     }
</script>
<!-- calendar -->
	<script type="text/javascript" src="{{('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',

			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}
		});
	</script>

	<!-- //calendar -->
</body>
</html>
