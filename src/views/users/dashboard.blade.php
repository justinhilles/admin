@extends('admin::layouts.default')

@section('main')
	<div class="row" id="dashboard">
		<div class="span12">
			<div class="row">
				@foreach(Config::get('admin::dashboard.fieldsets') as $legend => $fieldset)
					@include('admin::users._fieldset', compact('legend', 'fieldset'))
				@endforeach
			</div>
		</div>
	</div>
@stop