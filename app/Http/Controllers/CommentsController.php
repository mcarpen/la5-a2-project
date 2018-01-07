<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */

    public function index()
    {
        return view('comment.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comment.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ],
            [
                'content.required' => 'Content obligatoire'
            ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'body' => $request->body,
        ]);
        return redirect()->route('comment.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        if(!$comment) {
            return redirect()->route('comment.index');
        }
        return view('comment.show', compact('comment'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        if(!$comment) {
            return redirect()->route('comment.index');
        }
        return view('comment.edit', compact('comment'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required',
        ],
            [
                'content.required' => 'Content obligatoire'
            ]);
        $comment = Comment::find($id);
        $comment->body = $request->body;
        $comment->save();
        return redirect()->route('comment.show', [$comment->id])->with('success', 'Commentaire modifié');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('comment.index')->with('success', 'Commentaire supprimé');
    }
}
