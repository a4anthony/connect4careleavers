<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function confirm()
    {
        $req = Friend::where([
            ['user_id', \request('user_id')],
            ['friend_id', \request()->user()->id]
        ])->first();

        $req->update(['status' => true]);

        return redirect()->back();
    }

    public function addFriend()
    {
        $check = Friend::where([
            ['user_id', \request()->user()->id],
            ['friend_id', \request('friend_id')]
        ])->orWhere([
            ['user_id', \request('friend_id')],
            ['friend_id', \request()->user()->id]
        ])->exists();

        if (!$check) {
            Friend::create([
                'user_id' => \request()->user()->id,
                'friend_id' => \request('friend_id')
            ]);
        }
        return redirect()->back();
    }

    public function unfriend()
    {
        $friend = Friend::where([
            ['user_id', \request()->user()->id],
            ['friend_id', \request('friend_id')]
        ])->orWhere([
            ['user_id', \request('friend_id')],
            ['friend_id', \request()->user()->id]
        ])->first();


        if ($friend) {
            $friend->delete();
        }
        return redirect()->back();
    }
}
