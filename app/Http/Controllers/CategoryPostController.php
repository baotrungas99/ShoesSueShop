<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryPost;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\SliderModel;
use Auth;
class CategoryPostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function all_category_post()
    {
        $this->AuthLogin();

        $category = CategoryPost::get();
        $all_category_post = DB::table('tbl_category_post')->paginate(10);
        // $manager_category_post = view('admin.all_category_post')->with('all_category_post',$all_category_post)->with('category',$category);
        return view('admin.category_post.all_category_post')->with(compact('all_category_post','category'));

    }

    public function add_category_post()
    {
        $this->AuthLogin();
        return view('admin.category_post.add_category_post');
    }
    public function save_category_post(Request $request)
    {
        $this->AuthLogin();
        $data= $request->all();
        // dd($data);
        $category = new CategoryPost();
        $category->cate_post_name = $data['category_post_name'];
        $category->cate_post_slug = $data['slug_category_post'];
        $category->meta_keywords = $data['category_post_keywords'];
        $category->cate_post_desc = $data['category_post_description'];
        $category->cate_post_status = $data['category_post_status'];
        $category->save();

        // session::put('message','Adding category post successful');
        return redirect()->back()->with('message','Adding category post successful');
    }
    public function active_category_post($category_post_id) {
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id', $category_post_id)->update(['cate_post_status'=>0]);
        // session::put('message','List category Post active');
        return redirect()->back()->with('message','active category post successful');
    }
    public function unactive_category_post($category_post_id) {
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id', $category_post_id)->update(['cate_post_status'=>1]);
        // session::put('message','List category Post unactive');
        return redirect()->back()->with('message','unactive category post successful');
    }
    public function edit_category_post($category_post_id)
    {
        $this->AuthLogin();
        $cate = CategoryPost::get();
        $edit_category_post = DB::table('tbl_category_post')->where('category_post_id',$category_post_id)->get();
        // $manager_category_post = view('admin.edit_category_post')->with('edit_category_post',$edit_category_post);
        // return view('admin_layout')->with('admin.edit_category_post',$manager_category_post);
        return view('admin.category_post.edit_category_post')->with(compact('edit_category_post','cate'));
    }
    public function update_category_post(Request $request,$category_post_id)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['category_name'] = $request->category_post_name;
        // $data['slug_category_post'] = $request->slug_category_post;
        // $data['meta_keywords'] = $request->category_post_keywords;
        // $data['category_description'] = $request->category_post_description;

        // DB::table('tbl_category_post')->where('category_id', $category_post_id)->update($data);
        $data = $request->all();
        $category = CategoryPost::find($category_post_id);
        $category->cate_post_name = $data['category_post_name'];
        $category->cate_post_slug = $data['slug_category_post'];
        $category->meta_keywords = $data['category_post_keywords'];
        $category->cate_post_desc = $data['category_post_description'];
        // $category->cate_post_status = $data['category_post_status'];
        $category->save();

        // session::put('message','update category post successful');
        return Redirect::to('all-category-post')->with('message','update category post successful');

    }
    public function delete_category_post($category_post_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id', $category_post_id)->delete();
        // session::put('message','delete category post successful');
        return Redirect::to('all-category-post')->with('message','delete category post successful');

    }
}
