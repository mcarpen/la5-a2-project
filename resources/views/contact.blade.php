@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Get in touch!</h1>
                    </div>

                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <ul class="bg-danger">
                                @foreach($errors->all() as $error)
                                    <li><b>{{ $error }}</b></li>
                                @endforeach
                            </ul>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <input class="form-control" name="name" placeholder="Your name" value="{{ old('name') }}">
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                <input type="email" class="form-control" name="email" placeholder="Your email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
                                <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Message">{{ old('message') }}</textarea>
                            </div>

                            <button class="btn btn btn-primary center-block">Send us the message!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection