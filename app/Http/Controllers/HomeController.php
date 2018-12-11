<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    protected function showChangePassForm(Request $request){

        return view('auth.passwords.changespass');
    }
    protected function UserChangePassword(Request $request){

        $password = Auth::User()->password;
        $oldpassword = $request->oldpass;

        if (Hash::check($oldpassword, $password)){
           $user = User::findOrFail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('home'))->with('status', 'Your password has been changed successfully');
        }
        return redirect(route('user.password.request'))->with('status', 'Your old password does not match');
    }
}
