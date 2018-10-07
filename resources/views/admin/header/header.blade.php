<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid" style="background-image:url('images/theme.jpg');background-size: cover;background-attachment: ;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="{{ url('dashboard')}}" style="font-weight: bold;text-shadow: 2px 0 5px black;">Lapu-lapu City District Hospital Management System</a>
				<ul class="nav navbar-top-links navbar-right" style="border-color: red;">
					<li class="dropdown" style="padding-top:15px;background-color:transparent;color:white;text-transform: capitalize;font-weight: bold;text-shadow: 2px 0 5px black;">
						Welcome {{ Auth::user()->name }} !
					</li>
					<li class="dropdown" style="background-color: transparent;"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<img src="uploads/{{ Auth::user()->avatar }}" width="30" style="border-radius: 50%">
					</a>
						<ul class="dropdown-menu dropdown-alerts" style="width: 50px;">
							<li><a href="{{ url('/profile') }}">
								<em class="fa fa-user"></em>View Profile
									
							</a></li>
							<li class="divider"></li>
							<li>
								<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <em class="fa fa-power-off"></em> Log Out
                                </a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>