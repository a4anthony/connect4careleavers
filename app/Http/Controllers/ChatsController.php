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
    /**
     * Get messages between users
     *
     * @param $friendUsername
     *
     * @return \Inertia\Response
     */
    public function index($friendUsername)
    {
        $user = User::where('username', $friendUsername)->first();
        $authUser = request()->user();


        $userMsgsIds = $user->messages->where('friend_id', $authUser->id)->pluck('id');
        $authUserMsgsIds = $authUser->messages->where('friend_id', $user->id)->pluck('id');

        $msgIds = $userMsgsIds->merge($authUserMsgsIds);

        $msgs = Message::whereIn('id', $msgIds)->orderBy('created_at', 'ASC')->get()->toArray();

        return Inertia::render('Messages/Index', [
            'messages' => $msgs,
            'friend' => $user,
            'user' => \request()->user(),
            'pageTitle' =>   'Messages - ' . config('app.name'),
        ]);
    }

    /**
     * Fetch user messages
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetch()
    {
        return Message::with('user')->get();
    }

    /**
     * Send message
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $user = \request()->user();

        $message = Message::create([
            'user_id' => $user->id,
            'message' => \request('message'),
            'friend_id' => \request('friend_id')
        ]);

        broadcast(new MessageSent($message));
        
        return redirect()->back();
    }
}
