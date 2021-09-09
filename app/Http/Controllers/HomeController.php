<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;
use DB;
use Mail;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\LoginCustomer;
use Socialite;
use App\Models\Social;
use App\Models\SliderModel;
use App\Models\Order;
use App\Models\CategoryPost;
session_start();
class HomeController extends Controller
{
    public function contact_us(Request $request){
        //slide
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();
        //seo
        $meta_desc ="Sue Shoes";
        $meta_title="Sue | E-Shoes";
        $meta_keywords="Sue Bo";
        $url_canonical = $request->url();
        //end seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.contact_us.contact_us')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
    public function errors(){
        return view('errors.404');
    }
    public function index(Request $request){
        //slide
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();
        //seo
        $meta_desc ="Sue Shoes";
        $meta_title="Sue | E-Shoes";
        $meta_keywords="Sue Bo";
        $url_canonical = $request->url();
        //end seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(db::raw('RAND()'))->paginate(8);

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
        // return view('pages.home')->with(compact('cate_product','brand_product')); diferent way
    }
    public function search(request $request){
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        //seo
        $meta_desc = "search";
        $meta_keywords = "search";
        $meta_title = "search";
        $url_canonical = $request->url();
        //--seo
        $keyword = $request->keyword_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();

        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }

    //send mail
    public function send_mail(request $request) {
        //send mail
        $to_name = $request->shipping_name;
        $to_email = $request->shipping_email;//send to this email
        $ftotal = $request->session_cart_id;

        $data = array("name"=>"Mail từ Shop gửi đến tài khoản khách hàng","body"=>'Tổng hóa đơn:'.$ftotal); //body of mail.blade.php

        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

            $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail

        });
        // return redirect('/')->with('message','');
        //--send mail
        return redirect()->back();
    }
    public function login_google_customer(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google_customer(){
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = LoginCustomer::where('customer_id',$authUser->user)->first();
        // Session::put('customer_name',$account_name->customer_name);
        Session::put('customer_id',$account_name->customer_id);
        return redirect('/checkout')->with('message', 'Đăng nhập customer thành công');
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
        $login_gg = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);
        $orang = LoginCustomer::where('customer_email',$users->email)->first();

            if(!$orang){
                $orang = LoginCustomer::create([
                    'customer_name' => $users->name,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => '',
                ]);
            }

        $login_gg->login()->associate($orang);
        $login_gg->save();

        $account_name = LoginCustomer::where('customer_id',$login_gg->user)->first();
        // Session::put('admin_name',$account_name->admin_name);
        Session::put('customer_id',$account_name->customer_id);
        return redirect('/checkout')->with('message', 'Đăng nhập Customer thành công');
    }
    public function login_facebook_customer(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook_customer(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri
            $account_name = LoginCustomer::where('customer_id',$account->user)->first();
            // Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->customer_id);
            return redirect('/checkout')->with('message', 'Đăng nhập customer thành công');
        }else{

             $admin_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = LoginCustomer::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = LoginCustomer::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();

            $account_name = Login::where('admin_name',$account->user)->first();

            Session::put('admin_login',$account_name->admin_name);
            Session::put('admin_id',$account_name->customer_id);
            return redirect('/checkout')->with('message', 'Đăng nhập Customer thành công');
        }
    }
}
