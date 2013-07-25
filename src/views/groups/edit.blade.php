@extends('admin::layouts.default')

@section('main')
	<h1>Edit Group</h1>
	@include('admin::groups.form', compact($group))
@stop