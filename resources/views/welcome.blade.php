@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="text-center">Welcome to Colombe C & Matthieu C blog!</h1>
                    </div>
                    <div class="panel-body text-center" style="padding: 100px 0;">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ route('blog.index') }}" class="btn btn-primary">Go to blog!</a>
                                    <a href="{{ route('message.index') }}" class="btn btn-primary">Go to messages!</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary" style="font-size: 3em">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 3em">Register</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection