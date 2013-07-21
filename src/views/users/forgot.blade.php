@extends('admin::layouts.default')

@section('main')
    <div class="offset4 span3">
        <div class="well">
            <h3>Enter Your Email</h3>
            {{ Form::open(array('route' => 'admin.do_forgot')) }}
                @include('admin::global.flash')
                {{ Form::text('email', null, array('placeholder' => 'Email')) }}
                <button class="btn btn-primary" type="submit">Submit</button>
            {{ Form::close() }}
        </div>
    </div>
@stop