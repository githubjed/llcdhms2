<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="uploads/{{ Auth::user()->avatar}}" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name" style="text-transform: capitalize;">{{ Auth::user()->name }}</div>
								<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="divider"></div>
						<!-- <form role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
						</form> -->
		<ul class="nav menu">
			<li><a href="{{ url('dashboard') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			@if(Gate::check('isAdmin'))
			<li><a href="{{ url('employees') }}"><em class="fa fa-users">&nbsp;</em> Employee</a></li>
			@endif
			<li><a href="{{ url('patients') }}"><em class="fa fa-wheelchair">&nbsp;</em> Patient</a></li>
			<li><a href="{{ url('laboratories')}}"><em class="fa fa-flask">&nbsp;</em> Laboratory</a></li>
			<li><a href="{{ url('medicines')}}"><em class="fa fa-medkit">&nbsp;</em> Medicines</a></li>
			<li><a href="{{ url('create')}}"><em class="fa fa-history">&nbsp;</em> History</a></li>
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li> -->
			
		</ul>
	</div>