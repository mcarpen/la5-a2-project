<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $currentUser = Auth::id();

        $conversations = Conversation::where('user_one', '=', $currentUser)->orWhere('user_two', '=', $currentUser)->get();

        return view('message.index', compact('conversations'));
    }

    public function store($data)
    {
        $conv = new Conversation();
        $conv->user_one = $data['user_one'];
        $conv->user_two = $data['user_two'];
        $conv->last_message = $data['last_message'];
        $conv->save();
    }

    public function show($username)
    {
        if ($username === Auth::user()->name) {
            return redirect(route('message.index'));
        }

        $currentUser = Auth::id();
        $toUser = User::where('name', '=', $username)->first()->id;

        $conversation = Conversation::where([
            ['user_one', '=', $currentUser],
            ['user_two', '=', $toUser],
        ])->first();

        if ($conversation === null) {
            $conversation = Conversation::where([
                ['user_one', '=', $toUser],
                ['user_two', '=', $currentUser],
            ])->first();
        }

        $messages = Message::where('conversation_id', '=', $conversation->id)->orderBy('created_at', 'desc')->get();

        return view('message.conv', compact('messages', 'conversation', 'username'));
    }
}
