@extends('admin::layouts.default')

@section('main')
    <h1>Edit Permission</h1>
    @include('admin::permissions.form', compact('permission'))
@stop