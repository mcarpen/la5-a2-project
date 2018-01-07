@extends('layouts.app')

@section('content')
    <div class="container">
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