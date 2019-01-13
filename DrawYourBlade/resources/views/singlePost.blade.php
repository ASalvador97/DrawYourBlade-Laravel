@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                    {{ $entry -> title}}
                </div>

                <div class="panel-body">
                    <!-- if this is a new post, show a message -->
                    @if (Session::has('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    @endif
                    <img style="height: auto; width: auto; max-width: 100%; max-height: 80vh; display: block; margin: 0 auto;"
                         src="{{ asset('storage/'.$entry-> fileDir) }}" onmouseover="pixelate(this)"
                         onmouseout="normalizeImg(this)">
                    <p><b>Background: </b> {{ $entry -> content }}</p>
                    <br>
                    <p><b>Creator: </b> <a href="profile/{{ $user->id }}">{{ $user -> name }}</a></p>
                    <p><b>Creation date: </b> {{ $entry -> created_at }}</p>
                    <p><b>Last update: </b> {{ $entry -> updated_at }}</p>
                    <p><b>Type: </b> {{ $entry -> type}}</p>

                    @if(!Auth::guest() && (Auth::user()->id == $entry->creatorID || Auth::user()->type == 'admin' || Auth::user()->type == 'editor'))

                        <p><b>ID: </b> {{$entry -> id }}</p>
                        <a href='../post/{{$entry -> id }}/edit'>
                            <button type="button" class="btn btn-success">
                                Edit post
                            </button>
                        </a>
                        @if(!Auth::guest() && (Auth::user()->id == $entry->creatorID || Auth::user()->type == 'admin' ))
                            <a href='../post/{{$entry -> id }}/delete'>
                                <button type="button" class="btn btn-danger">
                                    Delete post
                                </button>
                            </a>
                        @endif
                    @endif

                    <a href='../'>
                        <button type="button" class="btn btn-primary">
                            Back to all posts
                        </button>
                    </a>
                </div>

                <br>


                @if(!Auth::guest())

                    <div class="panel-heading">
                        Submit a comment
                    </div>
                    <div class="panel-body">
                        {{ Form::open([
                                'url' => '/newComment/'.$entry->id,
                                'method'=>'POST',
                                'class' => 'form-horizontal',
                                'files' => false]) }}


                        @if (Session::has('error'))
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        {{ Session::get('error') }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (count($errors) > 0)
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="postTitle" class="col-md-4 control-label">Your comment:</label>
                            <div class="col-md-6">
                                <input id="postTitle" type="text" class="form-control" name="commentContent" required>
                            </div>
                        </div>

                        <div class="row text-center">
                            <input type="submit" class="btn btn-success" value="Submit comment">
                            <input type="hidden" value="PUT" name="_method">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
                    </div>

                    {{ Form::close() }}
                @endif

                <div class="row">
                    @foreach ($comments as $comment)
                        <div class="comment">
                            <div class="col-md-4 text-center">
                                <a href="../profile/{{ $comment->commentAuthorID }}">
                                    {{ App\User::find($comment->commentAuthorID)->name }}</a>
                                <small> {{$comment->created_at}}</small>

                            </div>
                            <div class="col-md-8">
                                <p> {{$comment->commentContent}}</p>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function pixelate(image) {
            image.src = "{{ asset('storage/'.$entry-> pixelatedDir) }}";
        }

        function normalizeImg(image) {
            image.src = "{{ asset('storage/'.$entry-> fileDir) }}";
        }
    </script>
@endsection