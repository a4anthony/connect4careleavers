<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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


    public function destroy()
    {
        $comment = Comment::where([['user_id', \request()->user()->id], ['id', \request('comment_id')]])->first();
        if ($comment) {
            $comment->delete();
        }
        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
