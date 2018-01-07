@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-block">
                    <div class="comments">
                        <div>
                            <a href="{{ route('message.create') }}" class="btn btn-primary">New message</a>
                        </div>
                        <br>
                        <ul class="list-group">
                            @foreach ($conversations as $conv)
                                <li class="list-group-item">
                                    @if($conv->lastFrom($conv->last_message) === Auth::user()->name)
                                        <strong>You:</strong> (to {{ $conv->toUser($conv) }})
                                    @else
                                        <strong>{{ $conv->lastFrom($conv->last_message) }}:</strong>
                                    @endif
                                    <br>
                                    <p>{{ $conv->lastMessage($conv->last_message)->content }}</p>
                                    <span>{{ $conv->lastMessage($conv->last_message)->created_at->diffForHumans() }}</span>
                                    <br>
                                    <div>
                                        <a href="@if ($conv->lastFrom($conv->last_message) === Auth::user()->name) {{ route('message.conv', $conv->toUser($conv)) }} @else {{ route('message.conv', $conv->lastFrom($conv->last_message)) }} @endif" class="btn btn-primary">View conversation</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection