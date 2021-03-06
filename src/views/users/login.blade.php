@extends('admin::layouts.simple')

@section('default')
    <div id="main" class="container">
        <div class="offset4 span3">
            <div class="well">
                <h3>Login</h3>
                {{ Form::open(array('route' => 'admin.do_login')) }}
                    @include('admin::global.flash')
                    {{ Form::text('email', null, array('placeholder' => 'Username')) }}
                    {{ Form::password('password', array('placeholder' => 'Password')) }}
                    <p>{{ link_to_route('admin.forgot', 'Forgot Password?') }}</p>
                    <button class="btn btn-primary" type="submit">Login</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

