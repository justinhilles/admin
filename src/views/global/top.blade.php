@if(isset($links) AND !empty($links))
	<ul id="top" class="nav nav-tabs">
		@foreach($links as $title => $link)
			@if(isset($link['route']) && !empty($link['route']))
				<li>{{ link_to_route($link['route'], $title)}}</li>
			@endif
		@endforeach
	</ul>
@endif