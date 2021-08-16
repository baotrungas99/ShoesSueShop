<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SliderModel;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
session_start();
class SliderController extends Controller
{
    //funtion Admmin page
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_slider(){
        $all_slide = SliderModel::orderby('slider_id','desc')->get();

        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }
    public function add_slider(){

        return view('admin.slider.add_slider');
    }
    public function insert_slider(request $request){
        $data = $request->all();
        // dd($data);
        $get_image = $request->file('slider_image');

        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_image_name));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/slider',$new_image);

            $slider = new SliderModel;
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_desc = $data['slider_desc'];
            $slider->slider_status = $data['slider_status'];
            $slider->save();

        Session::put('message','Adding slider successful');
        return Redirect::to('add-slider');
        }else{

            Session::put('message','Please input slide picture');
            return Redirect::to('add-slider');
        }

    }
    public function active_slider($slider_id) {
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>0]);
        session::put('message','slider active');
        return Redirect::to('manage-slider');
    }
    public function unactive_slider($slider_id) {
        $this->AuthLogin();
         DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>1]);
        session::put('message','slider unactive');
        return Redirect::to('manage-slider');
    }

}
