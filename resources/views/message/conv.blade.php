@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-block">
                    <div>
                        <a href="{{ route('message.index') }}" class="btn btn-primary">Back to my messages</a>
                    </div>
                    <br>
                    @if(count($errors) > 0)
                        <ul class="bg-danger">
                            @foreach($errors->all() as $error)
                                <li><b>{{ $error }}</b></li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('message.response', $username) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="content" placeholder="Your message here" class="form-control"> </textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Send!</button>
                        </div>
                        <input type="hidden" name="convId" value="{{ $conversation->id }}">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-block">
                    <div class="comments">
                        <ul class="list-group">
                            @foreach ($messages as $msg)
                                <li class="list-group-item" style="text-align: @if ($msg->user_id === Auth::id()) right @else left @endif">
                                    <p>{{ $msg->content }}</p>
                                    <span>{{  $msg->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection