@extends('admin::layouts.default')

@section('main')
    <div id="login">
        <div class="container">
            <form method="POST" action="{{{ Confide::checkAction('UserAdminController@do_login') ?: URL::to('/user/login') }}}" accept-charset="UTF-8" class="form-signin">
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <fieldset>
                    <label for="email">{{{ Lang::get('confide::confide.username_e_mail') }}}</label>
                    <input tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}" class="input-block-level"  />

                    <label for="password">
                        {{{ Lang::get('confide::confide.password') }}}
                        <small>
                            <a href="{{{ (Confide::checkAction('UserController@forgot_password')) ?: 'forgot' }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
                        </small>
                    </label>
                    {{ Form::password('password', null, array('class' => 'input-block-level')) }}

                    @include('admin::global.flash')
                    
                    <button tabindex="3" type="submit" class="btn btn-large btn-primary">{{{ Lang::get('confide::confide.login.submit') }}}</button>        
                </fieldset>
            </form>
        </div>
    </div>
@stop

