<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function update(Request $request){
        $validate = $request->validate([
            'image' => 'image|file',
            'visibility' => 'required'
        ]);

        if($request->file('image')){
            if ($request->oldimage) {
                Storage::delete($request->oldimage);
            }
            $validate['image'] = $request->file('image')->store('profile');
        }else{
            $validate['image'] = $request->oldimage;
        }

        if(auth()->user()->money < 100){
            $request->session()->flash('failed', 'Your coins are not enough! Current money: '.auth()->user()->money);
            return redirect()->back();
        }

        $user = User::find(auth()->user()->id);
        $user->money = $user->money - 100;
        $user->visibility = $validate['visibility'];
        $user->image = $validate['image'];
        $user->save();

        $request->session()->flash('success', 'Successfully updated your profile! Current money: '.auth()->user()->money-100);
        return redirect()->back();
    }
}
