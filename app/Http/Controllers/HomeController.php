<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function all()
    {
        //dd(Post::find(1));

        $user = \request()->user();
        $postIds = [];
        array_push($postIds, $user->id);
        $friendsId = $user->friends()->pluck('friend_id');
        foreach ($friendsId as $id) {
            array_push($postIds, $id);
        }
        $publicFeeds = Post::where('publicity', 'public')->latest()->get();
        $feeds = Post::whereIn('user_id', $postIds)->latest()->get();
        return Inertia::render('Welcome', [
            'feeds' => $feeds->merge($publicFeeds)
        ]);
    }


    public function likedPosts()
    {
        $likedPostsId = Like::where('user_id', \request()->user()->id)->get()->pluck('post_id');
        $feeds = Post::whereIn('id', $likedPostsId)->latest()->get();
        return Inertia::render('Welcome', [
            'feeds' => $feeds->merge($feeds)
        ]);
    }
}
