<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function all()
    {
        return Inertia::render('Admin/Dashboard', [
            'pageTitle' => 'Dashboard - ' . config('app.name'),
            'users' => User::whereNotIn('id', [\request()->user()->id])->get(),
            'messagesCount' => number_format(Message::count()),
            'postsCount' => number_format(Post::count()),
            'jobs' => Job::latest()->get(),
        ]);
    }

    public function makeAdmin()
    {
        User::find(\request('user_id'))->update([
            'is_admin' => true
        ]);
        return redirect()->back()->with('success', 'User made admin.');

    }

    public function removeAdmin()
    {
        User::find(\request('user_id'))->update([
            'is_admin' => false
        ]);
        return redirect()->back()->with('success', 'User removed as admin admin.');

    }


}
