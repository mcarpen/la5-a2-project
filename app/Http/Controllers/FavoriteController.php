<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param int $postId
     *
     * @return Response;
     */
    public function manage($postId)
    {
        $slug = Post::where('id', $postId)->first()->slug;
        $userId = Auth::user()->id;

        $fav = Favorite::where([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        $checkFav = $fav->exists();

        if ($checkFav) {
            $fav->delete();

            return redirect()->route('blog.show', ['slug' => $slug]);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'post_id' => $postId,
            ]);

            return redirect()->route('blog.show', ['slug' => $slug]);
        }
    }
}
