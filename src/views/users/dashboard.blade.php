@extends('admin::layouts.default')

@section('main')
	<div class="row" id="dashboard">
		<div class="span12">
			<div class="row">
				{{ Admin::dashboard() }}
			</div>
		</div>
	</div>
@stop