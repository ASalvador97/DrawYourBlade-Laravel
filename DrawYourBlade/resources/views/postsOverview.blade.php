<!-- the post overview page; the head and body parts will be removed in the end,
they are still present just for testing purposes; also, just a single css file
will be used in the end, but since we still haven't decided on the website's
final design, multiple css files are in use. -->

<!-- extends('layouts.app')

section('content') -->
	<head>
		<title>Posts overview</title>
		
		<!-- Bootstrap Core CSS -->
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

		<!-- Custom CSS, keeps the posts centered -->
		<link href="{{ asset('css/round-about.css') }}" rel="stylesheet">
		
		<!-- For the Dropdown to Work -->
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/tesdt.js') }}"></script>


	</head>

	<body>

		<!-- Black nav bar -->
		<nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{url('/profile/'.Auth::user()->id)}}">My profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
		<!-- End of the black nav bar -->
	
	
		<!-- Page Content -->
		<div class="container">
			<!-- Introduction Row -->
			<div class="row">
				<div class="col-lg-12">
					@if (Session::has('error'))
						<div class="col-md-12">
							<div class="alert alert-danger">
								{{ Session::get('error') }}
							</div>
						</div>
					@endif
					
					<h1 class="page-header">Posts
						@if (Auth::guest())
							<a href='../login' style="display:inline;">
								<button type="button" class="btn btn-info">
									Log in to submit a new post
								</button>
							</a>
						@else
							<a href='../newPost' style="display:inline;">
								<button type="button" class="btn btn-info">
									Submit a new post
								</button>
							</a>
							@if (Auth::user()->type == 'admin')
								<a href='../usersOverview' style="display:inline;">
									<button type="button" class="btn btn-danger">
										Admin panel
									</button>
								</a>	
							
								<a href='../getUserData' style="display:inline;">
									<button type="button" class="btn btn-danger">
										Download a .xlsx of all the users
									</button>
								</a>								
							@endif
						@endif
					</h1>
					
					<p>See your and other users' creations here.</p>
					
				</div>
			</div>

			<div class="row">
				@foreach ($submissions as $submission)
					<div class="col-lg-3 col-sm-6 text-center">
						<a href="post/{{ $submission->id }}">
							<img class="img-circle img-responsive img-center" src="{{ asset('storage/'.$submission-> circledDir) }}" alt=""
								onerror="backupThumb(this)" >
							<h3>{{ $submission->title }} </h3>
						</a>
								<small>
									By: <a href="profile/{{ $submission->creatorID }}">{{ App\User::find($submission->creatorID)->name }}</a>
								</small>
						<p>{{ $submission->description }}</p>
					</div>
				@endforeach 
			</div>

			<hr>

			<!-- Footer -->
			<footer>
				<div class="row">
					<div class="col-lg-12">
						<p>Copyright &copy; Draw Your Blade 2017</p>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
			</footer>

		</div>
		<!-- /.container -->

	</body>

<!--
endsection -->
