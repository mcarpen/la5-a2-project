@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{ $mediaUrl }}" alt="" class="img-responsive img-thumbnail">
                        <h2>{{ $post->title }}</h2>
                        @if($post->user) <h4>Author: {{ $post->user->name }}</h4> @endif
                    </div>
                    <div class="panel-body">
                        <p>{{ $post->body }}</p>
                        <span>
                            @if ($favCount <= 1)
                                {{ $favCount }} like ~
                            @else
                                {{ $favCount }} likes ~
                            @endif
                        </span>
                        @guest
                            <span>Please connect to like this article!</span>
                        @else
                            <a href="{{ route('favorite.manage', $post->id) }}">
                                @isset($inFav)
                                    Dislike it! :(
                                @else
                                    Like it! :)
                                @endisset
                            </a>
                        @endguest
                    </div>
                </div>

        <div class="card">
             <div class="card-block">
                 <div class="comments">

                     <ul class="list-group">

                         @foreach ($post->comments as $comment)

                             <li class="list-group-item">

                                 <strong>

                                     {{ $comment->created_at->diffForHumans() }}:

                                 </strong>

                                 {{ $comment->body }}

                                 <br>
                                 <p>By {{ $comment->user->name }}</p>

                             </li>

                         @endforeach

                     </ul>

                 </div>

                 @guest
                     <p>You must be connected to post a comment!</p>
                 @else
                     <form action="{{ route('comment.store', $post->slug) }}" method="POST">

                         {{ csrf_field() }}


                         <div class="form-group">
                             <textarea name="body" placeholder="Your comment here" class="form-control"> </textarea>
                         </div>

                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Add a comment </button>
                         </div>

                         <input type="hidden" name="postId" value="{{ $post->id }}">

                     </form>
                 @endguest

             </div>
        </div>

            </div>

        </div>

    </div>



@endsection