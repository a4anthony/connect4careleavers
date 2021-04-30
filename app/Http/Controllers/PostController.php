<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function store()
    {
        $randKey = Carbon::now()->format('_dnygis');
        $path = null;
        if (request()->file('image')) {
            $ext = '.' . request()->file('image')->getClientOriginalExtension();
            request()->file('image')->storeAs('public/posts', request()->user()->id . $randKey . $ext);
            $path = '/storage/posts/' . request()->user()->id . $randKey . $ext;
        }
        Post::create([
            'body' => \request('body'),
            'image' => $path,
            'publicity' => \request('publicity'),
            'user_id' => \request()->user()->id
        ]);
        return redirect()->route('home')->with('success', 'Posted successfully.');
    }

    public function like()
    {
        if (!Like::where([
            ['user_id', \request()->user()->id],
            ['post_id', \request('post_id')]
        ])->exists()) {
            Like::create([
                'user_id' => \request()->user()->id,
                'post_id' => \request('post_id')
            ]);
        }

        return redirect()->back();
    }

    public function unlike()
    {
        Like::where([
            ['user_id', \request()->user()->id],
            ['post_id', \request('post_id')]
        ])->delete();
        return redirect()->back();
    }

    public function destroy()
    {
        $post = Post::where([['user_id', \request()->user()->id], ['id', \request('post_id')]])->first();
        if ($post) {
            $post->delete();
        }
        return redirect()->route('home')->with('success', 'Posted deleted.');

    }
}