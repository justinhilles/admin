{{ link_to(Config::get('admin::config.prefix'), 'Dashboard', array('class' => 'brand')) }}
<div class="nav-collapse collapse">
	<ul id="nav" class="nav">
		{{ Admin::nav() }}
    </ul>
	<div class="pull-right">
		<ul class="nav pull-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Sentry::getUser()->first_name }} <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="/user/preferences"><i class="icon-cog"></i> Edit Profile</a></li>
					<li class="divider"></li>
					<li><a href="{{ URL::route('admin.logout') }}"><i class="icon-off"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div><!--/.nav-collapse -->