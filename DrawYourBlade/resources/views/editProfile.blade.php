@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				
				<div class="panel-heading">
					Edit profile
				</div>
				
				<div class="panel-body">
					<form method="POST" action="{{url('/editProfile/' . $user->id)}}"
						  class="form-horizontal">
						
						<div class="form-group">
							<label for="newEmail" class="col-md-4 control-label">New email: </label>
							<div class="col-md-6">
								<input type="text" class="form-control" value="{{$user->email}}"
								   name="newEmail">
							</div>
						</div>

						<div class="form-group">
							<label for="newName" class="col-md-4 control-label">New name: </label>
							<div class="col-md-6">
								<input type="text" class="form-control" value="{{$user->name}}"
								   name="newName">
							</div>
						</div>

						<div class="row text-center">
							<input type="submit" class="btn btn-success" value="Save Profile">
							<input type="hidden" value="PUT" name="_method">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						</div>
						
					</form>
					@if (Auth::user()->type == 'admin')
						<form method="POST" action="{{ url('changeType/'.$user->id) }}" class="form-horizontal">
							<select name="userType">
								
								<option value="user">User</option>
								<option value="admin">Admin</option>
								<option value="editor">Editor</option>
							</select>
								<div class="row text-center">
									<input type="submit" class="btn btn-success" value="Change Role">
									<input type="hidden" value="PUT" name="_method">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
								</div>
						</form>
					@endif
				
				</div>
			</div>
		</div>
	</div>
@endsection