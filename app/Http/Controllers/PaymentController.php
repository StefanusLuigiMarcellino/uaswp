<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        return view('payment');
    }

    public function pay(Request $request){
        $validate = $request->validate([
            'money' => 'required|numeric'
        ]);
        if($validate['money'] < auth()->user()->price){
            $request->session()->flash('failed', 'You are still underpaid IDR '. $validate['money']);
            return redirect()->back();
        }else{
            $user = User::find(auth()->user()->id);
            $user->money = $validate['money'] - $user->price;
            $user->status = 'paid';
            $user->save();
            return redirect('home');
        }
    }
}
