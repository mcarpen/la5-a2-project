<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage($id)
    {
        $message = Message::where('id', '=', $id)->first();

        return $message;
    }

    public function lastFrom($id)
    {
        $userId = $this->lastMessage($id)->user_id;
        $userName = User::find($userId)->name;

        return $userName;
    }

    public function toUser($conv)
    {
        $user_one = $conv->user_one;
        $user_two = $conv->user_two;
        $currentUser = Auth::id();

        $user_one === $currentUser ? $toUser = $user_two : $toUser = $user_one;

        $userName = User::where('id', '=', $toUser)->first()->name;

        return $userName;
    }
}
