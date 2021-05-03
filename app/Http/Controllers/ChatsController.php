<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\Notify;
use App\Models\Friend;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatsController extends Controller
{
    public function index($friendUsername)
    {
        //dd($friendUsername);
        $user = User::where('username', $friendUsername)->first();
        $authUser = request()->user();


        $userMsgsIds = $user->messages->where('friend_id', $authUser->id)->pluck('id');
        $authUserMsgsIds = $authUser->messages->where('friend_id', $user->id)->pluck('id');
        $msgIds = $userMsgsIds->merge($authUserMsgsIds);
        //dd($msgIds);

        $msgs = Message::whereIn('id', $msgIds)->orderBy('created_at', 'ASC')->get()->toArray();
//dd($msgs);
        //dump($user->messages->where('friend_id', $authUser->id));
        //dump($authUser->messages->where('friend_id', $user->id));
        //$msgs = $userMsgs->merge($authUserMsgs);
        //dd($msgs->latest());
        return Inertia::render('Messages/Index', [
            'messages' => $msgs,
            'friend' => $user,
            'user' => \request()->user()
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
            'message' => \request('message'),
            'friend_id' => \request('friend_id')
        ]);


        //event(new MessageSent($user, $message));


        //broadcast(new MessageSent($user, $message))->toOthers();
        broadcast(new MessageSent($message));

        broadcast(new Notify('New message from ' . $user->username));


        return redirect()->back();
    }
}
