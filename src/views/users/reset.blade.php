@extends('admin::layouts.simple')

@section('default')
    <div id="main" class="container">
        <div class="offset4 span3">
            <div class="well">
                <h3>Reset Password</h3>
                {{ Form::open(array('route' => array('admin.do_reset', $user->getResetPasswordCode()))) }}
                    @include('admin::global.flash')
                    {{ Form::password('password', array('placeholder' => 'Password')) }}
                    {{ Form::password('password_confirmation', array('placeholder' => 'Confirm Password')) }}
                    <button class="btn btn-primary" type="submit">Reset Password</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

