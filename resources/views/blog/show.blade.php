@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{ $mediaUrl }}" alt="">
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
                    <span>
                        @if ($favCount <= 1)
                            {{ $favCount }} like ~
                        @else
                            {{ $favCount }} likes ~
                        @endif
                    </span>
                    @guest
                        <span>Connectes-toi pour aimer l'article !</span>
                    @else
                        <a href="{{ route('favorite.manage', $post->id) }}">
                            @isset($inFav)
                                Je n'aime plus l'article
                            @else
                                J'aime l'article
                            @endisset
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection