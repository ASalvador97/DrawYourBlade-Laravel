@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
			
				<div class="panel-heading">
					Change avatar
				</div>
			
				<div class="panel-body">
					{{ Form::open([
						'url' => '/changeAvatar/'.$user->id, 
						'method'=>'POST',
						'class' => 'form-horizontal',  
						'files' => true]) }}
					
					<div class="form-group">
						{{ Form::label('source','Default 1', ['class' => 'col-md-4 control-label']) }}
						<div class="col-md-6">
							{{Form::radio('source', 's1', true) }}
							<img src="{{ asset('/storage/userContent/defaultAvatars/boy.png')}}">
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('source','Default 2', ['class' => 'col-md-4 control-label']) }}
						<div class="col-md-6">
							{{Form::radio('source', 's2') }}
							<img src="{{ asset('/storage/userContent/defaultAvatars/grill.png')}}">
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('image','Image', ['class' => 'col-md-4 control-label']) }}
						<div class="col-md-6">
							{{Form::radio('source', 's3') }}
							{{ Form::file('image'), ['class' => 'form-control'] }}
						</div>
					</div>
					<div class="row text-center">
						<input type="submit" class="btn btn-success" value="Upload Avatar">
						<input type="hidden" value="PUT" name="_method">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					</div>
				
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection