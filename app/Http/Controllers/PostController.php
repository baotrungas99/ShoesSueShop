<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\SliderModel;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Auth;
session_start();
class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_post() {
        $this->AuthLogin();
        $cate_post = CategoryPost::orderby('category_post_id','desc')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));
    }
   public function all_post()  {

        $this->AuthLogin();

        $all_post = DB::table('tbl_post')
        ->join('tbl_category_post','tbl_category_post.category_post_id','=','tbl_post.cate_post_id')
        ->orderby('tbl_post.post_id','desc')->paginate(5);

        // $all_post = Post::orderby('post_id','asc')->paginate(5);

        return view('admin.post.all_post')->with(compact('all_post'));
    }

    public function save_post(Request $request)
    {
        $data = $request->validate([
            //validation Laravel
            'post_title' => 'required',
            'cate_post_id' => 'required',
            'post_desc' => 'required',
            'post_content' => 'required',
            'post_meta_desc' => 'required',
            'post_meta_keyword' => 'required',
            'post_image' => 'required',
            'post_status' => 'required',
            'post_slug' => 'required',
        ]);
        // session::put('message, please fill all to add post');

        $this->AuthLogin();

        // $data = $request->all();
        $post = new Post();
        $post->post_title = $data['post_title'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keyword = $data['post_meta_keyword'];
        $post->post_image = $data['post_image'];
        $post->post_status = $data['post_status'];
        $post->post_slug = $data['post_slug'];
        // $data['post_image'] = $request->post_status;

        $get_image = $request->file('post_image');

        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();// get the name of the image
            $name_image = current(explode('.', $get_image_name)); // eg: current(image) end(.jpg)
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//random for different images
            $get_image->move('public/upload/post',$new_image);

            $post->post_image = $new_image;

            // DB::table('tbl_post')->insert($data);
            $post->save();
            // Session::put('message','Adding post successful');
            return redirect()->back()->with('message','Adding post successful');
        }else{
            return redirect()->back()->with('message','please add image to the post');
        }
    }
    public function active_post($post_id) {
        $this->AuthLogin();


        DB::table('tbl_post')->where('post_id', $post_id)->update(['post_status'=>0]);
        Session::put('message','Post active');
        return Redirect::to('all-post');
    }
    public function unactive_post($post_id) {
        $this->AuthLogin();

         DB::table('tbl_post')->where('post_id', $post_id)->update(['post_status'=>1]);
        Session::put('message',' Post unactive');
        return Redirect::to('all-post');
    }
    public function edit_post($post_id)
    {
        $this->AuthLogin();
        $cate_post = CategoryPost::orderby('category_post_id','desc')->get();
        $post = Post::where('post_id', $post_id)->get();
        return view('admin.post.edit_post')->with(compact('cate_post','post'));
    }
    public function update_post(Request $request,$post_id)
    {
        $this->AuthLogin();
        $data= $request->all();
        $post =  Post::find($post_id);
        $post->post_title = $data['post_title'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keyword = $data['post_meta_keyword'];
        // $post->post_image = $data['post_image'];
        // $post->post_status = $data['post_status'];
        $post->post_slug = $data['post_slug'];
        // $data['post_image'] = $request->post_status;

        $get_image = $request->file('post_image');

        if($get_image){
            $post_image = $post->post_image;
            unlink('public/upload/post/' . $post_image);
            $get_image_name = $get_image->getClientOriginalName();// get the name of the image
            $name_image = current(explode('.', $get_image_name)); // eg: current(image) end(.jpg)
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//random for different images
            $get_image->move('public/upload/post',$new_image);

            $post->post_image = $new_image;

            // DB::table('tbl_post')->insert($data);
            $post->save();
            // Session::put('message','Adding post successful');
            return redirect()->back()->with('message','Update post successful');
        }else{
            $post->save();
            return redirect()->back()->with('message','Update post successful');
        }
    }
    public function delete_post($post_id){
        $this->AuthLogin();

         $post = Post::find($post_id);
         $post_image = $post->post_image;
         unlink('public/upload/post/' . $post_image);// remove the image from source
         $post->delete();
         return redirect()->back()->with('message','Delete post successful');

    }
    //end admin function page
    //start client function page
    public function show_list_post(Request $request,$cate_post_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();
        $post = Post::orderby('post_id', 'desc')->where('post_status', '0')->take(5)->get();
        $post_by_id = DB::table('tbl_post')
        ->join('tbl_category_post','tbl_post.cate_post_id','=','tbl_category_post.category_post_id')
        ->where('tbl_category_post.cate_post_slug',$cate_post_slug)->get();

            foreach($post as $key => $val){
                $meta_desc = $val->post_desc;
                $meta_title= $val->post_title;
                $meta_keywords= $val->post_meta_keywords;
                $url_canonical = $request->url();
            }

        $category_post_name = DB::table('tbl_category_post')->where('cate_post_slug', $cate_post_slug)->limit(1)->get();

        return view('pages.post.list_new')->with('category',$cate_product)->with('brand',$brand_product)->with('post_by_id',$post_by_id)->with('category_post_name',$category_post_name)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
    public function show_detail_post(Request $request,$cate_post_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $slider = SliderModel::Orderby('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $category_post= CategoryPost::orderby('category_post_id', 'desc')->where('cate_post_status', '0')->take(5)->get();
        $post = Post::orderby('post_id', 'desc')->where('post_status', '0')->take(5)->get();
        $post_by_id = DB::table('tbl_post')
        ->join('tbl_category_post','tbl_post.cate_post_id','=','tbl_category_post.category_post_id')
        ->where('tbl_category_post.cate_post_slug',$cate_post_slug)->get();

            foreach($post as $key => $val){
                $meta_desc = $val->post_desc;
                $meta_title= $val->post_title;
                $meta_keywords= $val->post_meta_keywords;
                $url_canonical = $request->url();
            }

        $category_post_name = DB::table('tbl_category_post')->where('cate_post_slug', $cate_post_slug)->limit(1)->get();


        // return view('pages.post.simple_new')->with(compact('cate_product','brand_product','slider','category_post','category_post_name','meta_desc','meta_title','url_canonical','meta_keywords','category_post_name','post'));
        return view('pages.post.simple_new')->with('category',$cate_product)->with('brand',$brand_product)->with('post_by_id',$post_by_id)->with('category_post_name',$category_post_name)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
}
