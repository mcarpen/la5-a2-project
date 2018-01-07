<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('message.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user'     => 'required',
            'content'      => 'required',
        ]);

        $currentUser = Auth::id();
        $toUser = $request->get('user');

        $conv = Conversation::where([
            ['user_one', '=', $currentUser],
            ['user_two', '=', $toUser],
        ])->first();

        if ($conv === null) {
            $conv = Conversation::where([
                ['user_one', '=', $toUser],
                ['user_two', '=', $currentUser],
            ])->first();
        }

        if ($conv === null) {
            $conv           = new Conversation();
            $conv->user_one = $currentUser;
            $conv->user_two = $toUser;
            $conv->save();
        } else {
            $conv = Conversation::find($conv->id);
        }

        $message = new Message();
        $message->content = $request->get('content');
        $message->conversation_id = $conv->id;
        $message->user_id = $currentUser;
        $message->save();

        $conv->last_message = $message->id;
        $conv->save();

        return redirect()->route('message.create');
    }
}
