@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Mes articles</h1>
                    </div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <div class="col-sm-6">
                                <h3>{{ $post->title }}</h3>
                                <p>
                                    {{ $post->body }}
                                </p>
                                <a href="{{route('blog.show', $post->slug)}}" class="btn btn-primary">
                                    Voir
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection