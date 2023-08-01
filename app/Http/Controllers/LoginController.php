<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){

        $validate = $request->validate([
            'password' => 'required',
            'email' => 'required'
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();

            $status = auth()->user()->status;
            if($status == 'paid'){
                return redirect('/home');
            }else{
                return redirect('/payment');
            }
        }
        $request->session()->flash('failed', 'Authentication failed!');
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    }
}
