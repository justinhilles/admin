@if($legend AND $fieldset)
	<fieldset>
		<legend>{{ $legend }}</legend>
		@foreach($fieldset as $title => $link)
			@if(has_access_to_link($link))
				<div class="span3 icon" align="center">
					<a href="{{ URL::route($link['route'])}}">
						<i class="{{ $link['icon']}} icon-8x icon-border"></i><br/><br /><br />
						{{ $title }}
					</a>
				</div>
			@endif
		@endforeach
	</fieldset>
@endif