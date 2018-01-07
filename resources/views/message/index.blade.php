@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-block">
                    <div class="comments">
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
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection