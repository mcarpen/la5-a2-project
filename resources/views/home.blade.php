@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome back {{ Auth::user()->name }}!</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <div class="text-center">
                        <a href="{{ route('blog.index') }}" class="btn btn-primary">Go to blog!</a>
                        <a href="{{ route('message.index') }}" class="btn btn-primary">Go to messages!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
