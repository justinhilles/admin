{{ Form::tag('admin.users', (isset($user) ? $user : null)) }}
    
    <div class="control-group">
        {{ Form::label('username', 'Username:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::text('username') }}
        </div>
    </div>

	<div class="control-group">
        {{ Form::label('email', 'Email:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::text('email') }}
        </div>
    </div>

	<div class="control-group">
        {{ Form::label('password', 'Password:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::password('password') }}
        </div>
    </div>

	<div class="control-group">
        {{ Form::label('password_confirmation', 'Confirm Password:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::password('password_confirmation') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('role', 'Role:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::collection('roles', Role::all(), isset($user) ? $user->getRoleIds() : array(), array('key' => 'name', 'expand' => true)) }}
        </div>
    </div>

    {{ Form::buttons('admin.users.index')}}

{{ Form::close() }}

@include('admin.global.errors', array('errors' => $errors))