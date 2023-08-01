<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function add(Request $request){
        $sender = auth()->user()->id;
        $recipient = $request->id;

        Friend::create([
            'sender_id' => $sender,
            'recipient_id' => $recipient,
            'status' => 'accepted'
        ]);

        $request->session()->flash('success', 'Successfully added '.$request->name. ' as a friend');
        return redirect()->back();
    }
}
