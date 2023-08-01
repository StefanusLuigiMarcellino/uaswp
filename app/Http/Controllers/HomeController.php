<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $users = User::where('id', '<>', auth()->user()->id)->where('visibility', 'visible')->get();
        return view('home', ['users' => $users]);
    }

    public function topup(Request $request){
        $user = User::find(auth()->user()->id);
        $user->money = $user->money + $request->money;
        $user->update();
        return redirect()->back();
    }

    public function filter(Request $request){
        switch($request->input('action')){
            case 'Male':
                $users = User::where('id', '<>', auth()->user()->id)->where('gender', 'Male')->where('visibility', 'visible')->get();
                return view('home', ['users' => $users]);

            case 'Female':
                $users = User::where('id', '<>', auth()->user()->id)->where('gender', 'Female')->where('visibility', 'visible')->get();
                return view('home', ['users' => $users]);
        }
    }

}
