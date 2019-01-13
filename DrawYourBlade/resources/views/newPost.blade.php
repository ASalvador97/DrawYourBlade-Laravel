@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
			
				<div class="panel-heading">
					New post submission
				</div>
	
				<div class="panel-body">
					{{ Form::open([
						    'url' => '/newPost/', 
							'method'=>'POST',
							'class' => 'form-horizontal',  
							'files' => true]) }}
						
						
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
							{{ Form::label('image','Image', ['class' => 'col-md-4 control-label']) }}
							<div class="col-md-6">
								{{ Form::file('image'), ['class' => 'form-control'] }}
							</div>
						</div>
						
						<div class="form-group">
							<label for="postTitle" class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<input id="postTitle" type="text" class="form-control" name="postTitle" required autofocus>
							</div>
						</div>
						
						<div class="form-group">	
							<label for="postType" class="col-md-4 control-label">Type</label>
							<div class="col-md-6">
								<input id="postType" type="text" class="form-control" name="postType" required autofocus>
							</div>
						</div>	
						
						<div class="form-group">
							<label for="cont" class="col-md-4 control-label">Content</label>
							<div class="col-md-6">
								<textarea cols="40" rows="5" id="cont" type="text" class="form-control" name="cont"
								 placeholder="This here should be the whole description of your post - it is only visible when you go to the post's page." required autofocus></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label for="shortDescr" class="col-md-4 control-label">Short description</label>
							<div class="col-md-6">
								<textarea cols="40" rows="5"id="shortDescr" type="text" class="form-control" name="shortDescr" 
								 placeholder="This is just a short description, visible only under your submission's picture on the page with all the posts." required autofocus></textarea>
							</div>			
						</div>
							
							<div class="row text-center">
								<input type="submit" class="btn btn-success" value="Create Post">
								<input type="hidden" value="PUT" name="_method">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
							</div>
						</div>
						
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection