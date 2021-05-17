<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Show post
     *
     * @param $username
     * @param $postId
     *
     * @return \Inertia\Response
     */
    public function show($username, $postId)
    {
        $user = User::where('username', $username)->first();
        $feed = Post::where([
            ['user_id', $user->id],
            ['id', $postId]
        ])->latest()->paginate(5);

        return Inertia::render('Post', [
            'feed' => $feed,
            'pageTitle' => 'Posts - ' . config('app.name'),
        ]);
    }

    /**
     * Store new post
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
        return redirect()->back()->with('success', 'Posted successfully.');
    }

    /**
     * Like post
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Unlike post
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlike()
    {
        Like::where([
            ['user_id', \request()->user()->id],
            ['post_id', \request('post_id')]
        ])->delete();
        return redirect()->back();
    }

    /**
     * Delete post
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $post = Post::where([['user_id', \request()->user()->id], ['id', \request('post_id')]])->first();
        if ($post) {
            $post->delete();
        }
        return redirect()->back()->with('success', 'Posted deleted.');

    }
}
