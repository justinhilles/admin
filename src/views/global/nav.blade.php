{{ link_to(Config::get('admin::config.prefix'), 'Dashboard', array('class' => 'brand')) }}
<div class="nav-collapse collapse">
	<ul id="nav" class="nav">
		{{ Admin::nav() }}
    </ul>
	<div class="pull-right">
		{{ link_to(Config::get('admin::config.prefix').'/logout', 'Logout', array('class' => 'btn btn-danger')) }}
	</div>
</div><!--/.nav-collapse -->