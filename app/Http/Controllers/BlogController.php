<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts = DB::table('posts')
//            ->where('status', '1')
//            ->where('slug', 'mon-article')
//            ->get();

        $posts = Post::all();

        return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'body'      => 'required',
            'status'    => 'required',
            'postmedia' => 'required',
        ]);

        $postMedia = $request->file('postmedia');

        $path = Storage::putFileAs(
            'medias', $postMedia, $postMedia->getClientOriginalName()
        );

        $post           = new Post;
        $post->user_id  = $request->user()->id;
        $post->title    = $request->get('title');
        $post->slug     = str_slug($request->get('title'));
        $post->body     = $request->get('body');
        $post->status   = $request->get('status');
        $post->filename = $path;
        $post->save();

        return redirect()->route('blog.index');
    }

    /**
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post     = Post::where('slug', $slug)->first();
        $favCount = $post->favorites()->count();

        if ( ! $post) {
            return redirect()->route('blog.index');
        }

        $url      = Storage::url($post->filename);
        $mediaUrl = asset($url);

        if ( ! Auth::guest()) {
            $userId = Auth::user()->id;
            $inFav  = Favorite::where([
                ['post_id', $post->id],
                ['user_id', $userId],
            ])->exists();

            if ($inFav) {
                return view('blog.show', compact('post', 'inFav', 'favCount', 'mediaUrl'));
            } else {
                return view('blog.show', compact('post', 'favCount', 'mediaUrl'));
            }
        } else {
            return view('blog.show', compact('post', 'favCount', 'mediaUrl'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
