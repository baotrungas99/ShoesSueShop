<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend
Route::get('/','HomeController@index');
Route::get('/404','HomeController@errors');
Route::get('/homepage','HomeController@index');
Route::post('/search','HomeController@search');
Route::get('/contact','HomeController@contact_us');

//category show in home view
Route::get('/category-product/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('/brand-product/{brand_slug}','BrandProduct@show_brand_home');
Route::get('/detail-product/{product_slug}','ProductController@details_product');

Route::get('/category-post/{cate_post_slug}','CategoryPostController@show_category_post_home');

//backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');

route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

// category Post
Route::get('/add-category-post', 'CategoryPostController@add_category_post');
Route::get('/all-category-post', 'CategoryPostController@all_category_post');

Route::post('/save-category-post', 'CategoryPostController@save_category_post');

Route::get('/unactive-category-post/{category_post_id}','CategoryPostController@unactive_category_post');
Route::get('/active-category-post/{category_post_id}','CategoryPostController@active_category_post');

Route::get('/edit-category-post/{category_post_id}','CategoryPostController@edit_category_post');
Route::get('/delete-category-post/{category_post_id}','CategoryPostController@delete_category_post');
Route::post('/update-category-post/{category_post_id}','CategoryPostController@update_category_post');

// post
Route::get('/add-post', 'PostController@add_post');
Route::get('/all-post', 'PostController@all_post');
Route::post('/save-post', 'PostController@save_post');
Route::get('/unactive-post/{post_id}','PostController@unactive_post');
Route::get('/active-post/{post_id}','PostController@active_post');

Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::post('/update-post/{post_id}','PostController@update_post');
Route::get('/delete-post/{post_id}','PostController@delete_post');

// show Post News
Route::get('/category-post/{cate_post_slug}','PostController@show_list_post');
Route::get('/detail-post/{cate_post_slug}','PostController@show_detail_post');

// slider--banner
Route::get('/manage-slider', 'SliderController@manage_slider');
route::get('/add-slider','SliderController@add_slider');
route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');

//category product in admin view
route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');


Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');


Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');


Route::post('/export-csv','CategoryProduct@export_csv');
Route::post('/import-csv','CategoryProduct@import_csv');

//brand product in admin view
route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');


Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');


Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

//product in admin view
route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');


Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');


Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

//cart
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowID}','CartController@delete_cart');
Route::get('/delete-product-cart/{session_id}','CartController@delete_product_cart');
Route::post('/update-cart-qty','CartController@update_cart_qty');
Route::post('/update-cart','CartController@update_cart');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/show-cart-ajax','CartController@cart_ajax');
Route::get('/del-all-product-cart','CartController@del_all_product_cart');

//Coupon Cart
Route::post('/check-coupon','CartController@check_coupon');//check_coupon
//coupon Admin
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');

//checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');

Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');

Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

Route::post('/order-place','CheckoutController@order_place');

Route::post('/selete-delivery-home','CheckoutController@selete_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::get('/del-fee','CheckoutController@del_fee');

Route::post('/confirmed-order','CheckoutController@confirmed_order');


//orders
// Route::get('/manage-orders','CheckoutController@manage_orders');
// Route::get('/view-orders/{order_id}','CheckoutController@view_orders');

Route::get('/manage-orders','OrderController@manage_orders');
Route::get('/view-orders/{order_code}','OrderController@view_orders');

Route::get('/print-orders/{checkout_code}','OrderController@print_orders');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');

//send mail
Route::get('/send-mail','HomeController@send_mail');

//customer login
Route::get('/login-facebook-customer','HomeController@login_facebook_customer');//facebook
Route::get('/customer/callback','HomeController@callback_facebook_customer');
Route::get('/login-google-customer','HomeController@login_google_customer');//google
Route::get('/googlecustomer/callback','HomeController@callback_google_customer');
//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');
//login Google admin
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');

//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/selete-delivery','DeliveryController@selete_delivery');

Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/selete-feeship','DeliveryController@selete_feeship');
Route::post('/update-feeship','DeliveryController@update_feeship');

//authentication routes for admin row
Route::get('/register-auth','AuthController@register_auth');
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');

//User routes
Route::get('/users','UserController@index')->middleware('roles');
Route::get('add-users','UserController@add_users');
Route::get('delete-user-role/{admin_id}','UserController@delete_user_role');
Route::post('store-users','UserController@store_users');
Route::post('assign-roles','UserController@assign_roles')->middleware('roles');
Route::group(['middleware' => 'roles'], function () {
    // Route::get('/add-product','ProductController@add_product');
	// Route::get('/edit-product/{product_id}','ProductController@edit_product');
 });

 Route::get('impersonate/{admin_id}','UserController@impersonate');
 Route::get('impersonate-destroy','UserController@impersonate_destroy');

