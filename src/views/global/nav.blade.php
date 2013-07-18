{{ link_to(Config::get('admin::config.prefix'), 'Dashboard', array('class' => 'brand')) }}
<div class="nav-collapse collapse">
	<ul id="nav" class="nav">
		@foreach(Config::get('admin::dashboard.fieldsets') as $legend => $fieldset)
			@foreach($fieldset as $title => $link)
				<li>{{ link_to_route($link['route'],$title)}}</li>
			@endforeach
		@endforeach
    </ul>
	<div class="pull-right">
		{{ link_to(Config::get('admin::config.prefix').'/logout', 'Logout', array('class' => 'btn btn-danger')) }}
	</div>
</div><!--/.nav-collapse -->