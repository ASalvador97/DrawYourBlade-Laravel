@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
			
				<div class="panel-heading">
					Edit a post
				</div>
	
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{url('/post/'.$post->id.'/edit')}}">


						<div class="form-group">
							<label for="postTitle" class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<input id="postTitle" type="text" class="form-control" name="postTitle" value="{{ $post->title }}" required autofocus>
							</div>
						</div>
						
						<div class="form-group">	
							<label for="postType" class="col-md-4 control-label">Type</label>
							<div class="col-md-6">
								<input id="postType" type="text" class="form-control" name="postType" value="{{ $post->type }}" required autofocus>
							</div>
						</div>	
						
						<div class="form-group">
							<label for="cont" class="col-md-4 control-label">Content</label>
							<div class="col-md-6">
								<textarea cols="40" rows="5" id="cont" type="text" class="form-control" name="cont"
								 required autofocus>{{ $post->content }}</textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label for="shortDescr" class="col-md-4 control-label">Short description</label>
							<div class="col-md-6">
								<textarea cols="40" rows="5"id="shortDescr" type="text" class="form-control" name="shortDescr" 
								 required autofocus>{{ $post->description }}</textarea>
							</div>			
						</div>
							
						<div class="row text-center">
							<input type="submit" class="btn btn-success" value="Save changes">
							<input type="hidden" value="PUT" name="_method">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection