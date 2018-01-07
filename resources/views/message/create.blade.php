@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Send message</h1>
                    </div>

                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <ul class="bg-danger">
                                @foreach($errors->all() as $error)
                                    <li><b>{{ $error }}</b></li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('message.store') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                                <textarea class="form-control" name="content" cols="30" rows="10" placeholder="Message">{{ old('content') }}</textarea>
                            </div>

                            <div class="form-group">
                                <select name="user" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn btn-primary center-block">Send!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection