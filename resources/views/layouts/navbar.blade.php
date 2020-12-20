</head>
<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
	<div class="navbar-brand">
		<a href="{{ route('home') }}" class="d-inline-block">
			<img src="/global_assets/images/logo_light.png" alt="">
		</a>
	</div>

	<div class="d-md-none">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>
		<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
			<i class="icon-paragraph-justify3"></i>
		</button>
	</div>

	<div class="collapse navbar-collapse" id="navbar-mobile">
		<span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

		<ul class="navbar-nav">
			<li class="nav-item dropdown dropdown-user">
				<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
					<img src="/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
					<span>{{ auth()->user()->name }}</span>
				</a>

				<form id="logout" action="{{ route('logout') }}" method="POST">{{ csrf_field() }}</form>

				<div class="dropdown-menu dropdown-menu-right">
					<a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout').submit();">
						<i class="icon-switch2"></i> Logout
					</a>
				</div>
			</li>
		</ul>
	</div>
</div>
	<!-- /main navbar -->