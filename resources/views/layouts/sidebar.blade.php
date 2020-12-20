	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="/global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{ auth()->user()->name }}</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-envelop5 font-size-sm"></i> &nbsp;{{ auth()->user()->email }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="index.html" class="nav-link {{ request()->routeIs('home*') ? 'active' : '' }}">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers*') ? 'active' : '' }}">
								<i class="icon-users"></i>
								<span>
									Customer
								</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">
								<i class="icon-list3"></i>
								<span>
									Products
								</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('sales-order.index') }}" class="nav-link {{ request()->routeIs('sales-order*') ? 'active' : '' }}">
								<i class="icon-cart5"></i>
								<span>
									Sales Order
								</span>
							</a>
						</li>

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">