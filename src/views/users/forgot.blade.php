@extends('admin::layouts.simple')

@section('default')
    <div id="main" class="container">
        <div class="offset4 span3">
            <div class="well">
                <h3>Reset Password</h3>
                {{ Form::open(array('route' => 'admin.do_forgot')) }}
                    @include('admin::global.flash')
                    {{ Form::text('email', null, array('placeholder' => 'Username')) }}
                    <button class="btn btn-primary" type="submit">Send Email</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

