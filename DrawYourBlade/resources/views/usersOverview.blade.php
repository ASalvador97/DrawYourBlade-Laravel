@extends('layouts.app')

@section('content')
	
	
	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Here you can see an overview of all the users with their posts.
				</div>
				
				<div class="panel-body">
					@foreach ($users as $user)
						<div>
							<div style="display:inline-block; margin-left:10px; vertical-align:top">
								<img class="img-circle img-responsive img-center" src="{{ asset('storage/'.$user-> avatarDir) }}">
							</div>
							
							<div style="display:inline-block; margin:40px; vertical-align:middle">
								<p><b>ID: </b> {{$user -> id }}</p>
								<p><b>User Type: </b> {{ $user -> type }}
								<p><b>Email: </b> {{ $user -> email}}</p>
								<p><b>Name: </b> {{ $user -> name}}</p>
							</div>
							
							<div style= "display:inline-block; float:right;">
								<a href="{{url('/profile/' . $user->id)}}">
									<button class="btn">Visit profile</button>
								</a>
								<a href="{{url('/editProfile/' . $user->id)}}">
									<button class="btn">Edit profile</button>
								</a>
								<a href="{{url('/changeAvatar/' . $user->id)}}">
									<button class="btn">Change avatar</button>
								</a>
								
								<br><br>

								<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#{{ $user->id }}" aria-expanded="false">
									Show all posts
								</button>
								<a href="{{url('profile/'.$user->id.'/delete')}}">
									<button class="btn btn-danger">Delete user</button>
								</a>
							</div>
						</div>
						
						<div class="collapse" id="{{ $user->id }}" style="margin-left:20px;">
							@foreach ($posts as $post)
								@if($post -> creatorID == $user -> id)
									<div style="margin:20px">
										<div style="display:inline-block; margin-left:10px; vertical-align:top">
											<img class="img-circle img-responsive img-center" src="{{ asset('storage/'.$post-> circledDir) }}"
												alt="" onerror="backupThumb(this)">
										</div>
										
										<div style="display:inline-block; margin:40px; vertical-align:middle">
											<p><b>Post title: </b> {{ $post -> title }}</p>
											<p><b>Post description: </b> {{ $post -> description }}</p>
										</div>
										
										<div style= "display:inline-block; float:right;">
											<a href='../post/{{$post -> id }}'>
												<button type="button" class="btn">
													View post
												</button>
											</a>
											<a href='../post/{{$post -> id }}/edit'>
												<button type="button" class="btn">
													Edit post
												</button>
											</a>
											<a href='../post/{{$post -> id }}/delete'>
												<button type="button" class="btn btn-danger">
													Delete post
												</button>
											</a>
										</div>
									</div>
									<hr>
								@endif
							@endforeach
						</div>
						
						<hr>
						
					@endforeach
				</div>
			</div>					
		</div>				
	</div>
@endsection