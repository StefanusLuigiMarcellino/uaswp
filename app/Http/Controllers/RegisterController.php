<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index(){
        $randomNumber = mt_rand(100000, 125000);
        return view('register', ['random' => $randomNumber]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'instagram' => 'required',
            'hobbies' => 'required|array|min:3',
            'hobbies.*' => 'string|distinct|exists:hobbies,hobby',
            'phone' => 'required|regex:/^[0-9]{10,14}$/',
            'gender' => 'required',
            'image' => 'required|image',
            'password' => 'required_with:confirm|same:confirm_password'
        ]);

        $validate['image'] = $request->file('image')->store('profile');
        $validate['password'] = bcrypt($validate['password']);
        $user = User::create([
            'price' => $request->input('price'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'instagram' => $request->input('instagram'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'image' => $validate['image'],
            'password' => $validate['password']
        ]);
        $hobbyIds = Hobby::whereIn('hobby', $request->input('hobbies'))->pluck('id');
        $user->hobbies()->attach($hobbyIds);
        $request->session()->flash('success', 'Congratulations, you can log in now');
        return redirect('/login');
    }


}
