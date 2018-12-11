<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    protected function showChangepassForm(){
        return view('admin.passwords.adminchangepass');
    }
    protected function AdminChangePassword(Request $request){

        $password = Auth::User()->password;
        $oldpassword =$request->oldpass;
        if (Hash::check($oldpassword,$password)){

           $user = Admin::findOrFail(Auth::id());
           $user->password = Hash::make($request->password);
           $user->save();
           return redirect(route('admin.dashboard'))->with('status', 'Your password has been changed successfully');
        }
        return redirect(route('admin.password.changes'))->with('status', 'Your old password does not match');
    }


}
