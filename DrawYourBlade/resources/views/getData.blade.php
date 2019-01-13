@extends('layouts.app')

@section('content')
	
	
	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<div class="panel panel-warning">
				<div class="panel-heading">
					So you want to download the info file about all the users?
				</div>
			</div>
		
			<form class="row text-center" method="POST" action="{{url('getUsersdata')}}">
				<input type="hidden" value="PUT" name="_method">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
	
				<button type="submit" class="btn btn-success">
					Yep, I want to download it.
				</button>
				
			</form>
					
		</div>				
	</div>
@endsection