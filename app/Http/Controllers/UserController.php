<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\Roles;
use App\Models\Admin;
use Session;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function add_users(){
        return view('admin.users.add_users');
    }
    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
            return redirect()->back()->with('message','You cannot Assign a Role to yourself');
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();//hủy hết các phân quyền trước dó - - - - -- - - - tháo liên kết giữa user và roles
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());
        }
        if($request['viewer_role']){
            $user->roles()->attach(Roles::where('name','viewer')->first());
         }
        return redirect()->back()->with('message','Assign Role successfully');
    }
    public function delete_user_role($admin_id){
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','You cannot delete yourself');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','delete user successfully');

    }
    public function store_users(Request $request){// add user function
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','viewer')->first());
        Session::put('message','Add users successfully');
        return Redirect::to('users');
    }
    public function impersonate($admin_id) {
        $user = Admin::where('admin_id', $admin_id)->first();
        if($user){
            session()->put('impersonate',$user->admin_id);
        }
        return redirect('/users');
    }
    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/users');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
