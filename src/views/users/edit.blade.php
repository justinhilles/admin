@extends('admin::layouts.default')

@section('main')
    <h1>Edit User</h1>
    @include('admin::users.form', compact('user'))
@stop