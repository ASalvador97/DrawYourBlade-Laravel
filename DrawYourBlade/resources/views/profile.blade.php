@extends('layouts.app')

@section('content')
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
				
					<div class="panel-heading">
						This is your profile page.
					</div>
					
					<div class="panel-body">
						<img class="img-circle img-responsive img-center" src="{{ asset('storage/'.$user-> avatarDir) }}">
						<p><b>ID: </b> {{$user -> id }}</p>
						<p><b>User Type: </b> {{ $user -> type }}
						<p><b>Email: </b> {{ $user -> email}}</p>
						<p><b>Name: </b> {{ $user -> name}}</p>
						
						@if(Auth::user()->id == $user-> id || Auth::user()->type == 'admin')
							<a href="{{url('/editProfile/' . $user->id)}}">
								<button class="btn btn-primary">Edit profile</button>
							</a>
							<a href="{{url('/changeAvatar/' . $user->id)}}">
								<button class="btn btn-success">Change Avatar</button>
							</a>
							
							@if(Auth::user()->type == 'admin')
								<a href="{{url('profile/'.$user->id.'/delete')}}">
									<button class="btn btn-danger">Delete User</button>
								</a>
							@endif
						@endif
						
					</div>
				</div>
			</div>
		</div>
@endsection