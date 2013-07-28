@if($legend AND $fieldset)
	@foreach($fieldset as $title => $link)
		@if(has_access_to_link($link))
		<?php if(!isset($content)):?>
			<?php $content = null;?>
		<?php endif;?>
		<?php $content .='
			<div class="span3 icon" align="center">
				<a href="'. URL::route($link['route']). '">
					<i class="'. $link['icon'].' icon-8x icon-border"></i><br/><br /><br />
					' .$title.'
				</a>
			</div>';?>
		@endif
	@endforeach
@endif

@if(isset($content) AND !empty($content))
	<fieldset>
		<legend>{{ $legend }}</legend>
		{{ $content }}
	</fieldset>
@endif