<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function articles(Request $request) {
        $user = $request->user();
        $articles = $user->articles;
        
        return view('user.articles', compact('articles'));
    }
}
