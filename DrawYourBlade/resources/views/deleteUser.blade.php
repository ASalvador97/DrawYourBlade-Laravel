@extends('layouts.app')

@section('content')
	
	
	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Are you <b>absolutely</b> sure you want to delete the following user and all his posts?
				</div>
				
				<div class="panel-body">
					<div class="col-md-9 col-md-offset-2">
					
						<div class="panel panel-default">
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
							<hr>
						</div>
						
						<div style="margin-left:20px;">
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
										
									</div>
									<hr>
								@endif
							@endforeach
						</div>
								
						</div>
					</div>
				</div>
			</div>
		
			<form class="row text-center" method="POST" action="{{url('/profile/'.$user->id.'/delete')}}">
				<input type="hidden" value="PUT" name="_method">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
						
				<a href='../'>
					<button type="button" class="btn btn-danger">
						No, what was I thinking?!
					</button>
				</a>
				
				
				<button type="submit" class="btn btn-warning">
					Yeah, pretty sure.
				</button>
				
			</form>
					
		</div>				
	</div>
@endsection