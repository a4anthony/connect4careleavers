<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatsController extends Controller
{
    public function index()
    {
        $user = request()->user();
        //dd($user->messages);
        return Inertia::render('Messages/Index', [
            'messages' => $user->messages
        ]);
    }

    public function fetch()
    {
        return Message::with('user')->get();
    }


    public function send(Request $request)
    {
        $user = \request()->user();

        $message = Message::create([
            'user_id' => $user->id,
            'message' => \request('message')
        ]);


        //event(new MessageSent($user, $message));



        //broadcast(new MessageSent($user, $message))->toOthers();
        broadcast(new MessageSent($user, $message));


        return redirect()->back();
    }
}
