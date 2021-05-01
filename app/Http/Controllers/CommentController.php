<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\LikeComment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store()
    {
        Comment::create([
            'user_id' => \request()->user()->id,
            'post_id' => \request('post_id'),
            'body' => \request('body'),
        ]);

        return redirect()->back()->with('success', 'Comment added.');
    }

    public function like()
    {
        if (!LikeComment::where([
            ['user_id', \request()->user()->id],
            ['comment_id', \request('comment_id')]
        ])->exists()) {
            LikeComment::create([
                'user_id' => \request()->user()->id,
                'comment_id' => \request('comment_id')
            ]);
        }

        return redirect()->back();
    }

    public function unlike()
    {
        LikeComment::where([
            ['user_id', \request()->user()->id],
            ['comment_id', \request('comment_id')]
        ])->delete();
        return redirect()->back();
    }

    public function destroy()
    {
        $comment = Comment::where([['user_id', \request()->user()->id], ['id', \request('comment_id')]])->first();
        if ($comment) {
            $comment->delete();
        }
        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
