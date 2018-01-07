<?php

namespace App\Http\Controllers;

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

        $message = new Message();
        $message->from_id = Auth::id();
        $message->to_id = $request->get('user');
        $message->content = $request->get('content');
        $message->save();

        return redirect()->route('message.create');
    }
}
