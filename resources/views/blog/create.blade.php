@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Create an article</h1>
                    </div>

                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <ul class="bg-danger">
                                @foreach($errors->all() as $error)
                                    <li><b>{{ $error }}</b></li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                <input class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                            </div>

                            <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                                <textarea class="form-control" name="body" cols="30" rows="10"
                                          placeholder="Text">{{ old('body') }}</textarea>
                            </div>

                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="0">Draft</option>
                                    <option value="1">Published</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input name="postmedia" type="file">
                            </div>

                            <button class="btn btn-primary center-block">Save!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection