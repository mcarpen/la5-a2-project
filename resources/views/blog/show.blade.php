@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ $post->title }}

                            @if($post->user)
                                Auteur: {{ $post->user->name }}
                            @endif
                        </h2>
                    </div>
                    <p>
                        {{ $post->body }}
                    </p>

                    <div class="comments">

                        <ul class="list-group">

                        @foreach ($post->comments as $comment)

                            <li class="list-group-item">

                                <strong>

                                    {{ $comment->created_at->diffForHumans() }}:

                                </strong>

                                {{ $comment ->body }}

                            </li>

                         @endforeach

                        </ul>

                    </div>

                </div>

        <div class="card">
             <div class="card-block">
                 <form action="{{ route('comment.store') }}" method="POST">

                     {{ csrf_field() }}


                     <div class="form-group">
                         <textarea name="body" placeholder="your comment here" class="form-control"> </textarea>
                     </div>

                     <div class="form-group">
                         <button type="submit" class="btn btn-primary">Add a comment </button>
                     </div>

                 </form>

             </div>
        </div>

            </div>

        </div>

    </div>



@endsection