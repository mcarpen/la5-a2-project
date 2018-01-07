<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $userId;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userId = Auth::id();

            view()->share('newMessages', $this->checkMessages($this->userId));

            return $next($request);
        });
    }

    public function checkMessages($userId)
    {
        $conversations = Conversation::where('user_one', '=', $userId)->orWhere('user_two', '=', $userId)->get();

        $total = 0;
        foreach ($conversations as $conv) {
            $count = Message::where([
                ['user_id', '!=', $userId],
                ['conversation_id', '=', $conv->id],
                ['viewed', '=', 0],
            ])->count();
            $total += $count;
        }

        return $total;
    }
}
