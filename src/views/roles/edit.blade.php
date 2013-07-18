@extends('admin::layouts.default')

@section('main')
	<h1>Edit Role</h1>
	@include('admin::roles.form', compact($role))
@stop