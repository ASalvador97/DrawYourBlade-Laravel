@extends('layouts.app')

@section('content')
	
	
	<div class="row">
		<div class="col-md-9 col-md-offset-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Are you <b>absolutely</b> sure you want to delete the following post?
				</div>
				
				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2">
					
						<div class="panel panel-default">
						
							<div class="panel-heading">
								Post information.
							</div>
							
							<div class="panel-body">
								<img src="{{ asset('storage/'.$entry-> fileDir) }}">				
								<p><b>ID: </b> {{$entry -> id }}</p>
								<p><b>Title: </b> {{ $entry -> title}}</p>
								<p><b>Creator: </b> {{ $user -> name }}</p>
								<p><b>Type: </b> {{ $entry -> type}}</p>
								<p><b>Content: </b> {{ $entry -> content }}</p>	  
								<p><b>Creation date: </b> {{ $entry -> created_at }}</p>
								<p><b>Last update: </b> {{ $entry -> updated_at }}</p>
							</div>
								
						</div>
					</div>
				</div>
			</div>
		
			<form class="row text-center" method="POST" action="{{url('/post/'.$entry->id.'/delete')}}">
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