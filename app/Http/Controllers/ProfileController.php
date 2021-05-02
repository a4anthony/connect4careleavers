<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        $friendsId1 = Friend::where('user_id', $user->id)
            ->get()->pluck('friend_id');
        $friendsId2 = Friend::where([['status', true], ['friend_id', $user->id]])
            ->get()->pluck('user_id');
        $friendsId = $friendsId1->merge($friendsId2);
        $friendRequestsId = Friend::where([['status', false], ['friend_id', $user->id]])
            ->get()->pluck('user_id');

        if (($key = array_search($user->id, $friendsId->toArray())) !== false) {
            unset($friendsId[$key]);
        }
        if (($key = array_search($user->id, $friendRequestsId->toArray())) !== false) {
            unset($friendsId[$key]);
        }

        $friends = User::whereIn('id', $friendsId)->latest()->get()->toArray();
        $friendRequests = User::whereIn('id', $friendRequestsId)->latest()->get()->toArray();

        return Inertia::render('Profile/Index', [
            'user' => $user,
            'feeds' => Post::where('user_id', $user->id)->latest()->paginate(5),
            'currentUser' => \request()->user()->id === $user->id,
            'friends' => $friends,
            'friendRequests' => $friendRequests,
        ]);
    }

    public function edit()
    {
        return Inertia::render('Profile/Edit', [
            'user' => \request()->user(),
        ]);
    }

}
