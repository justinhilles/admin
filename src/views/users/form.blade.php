{{ Form::tag('admin.users', (isset($user) ? $user : null), false, array('class' => 'form-horizontal')) }}

    <div class="control-group">
        {{ Form::label('first_name', 'First Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('first_name') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('last_name', 'Last Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('last_name') }}
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
        {{ Form::label('activated', 'Activated?:', array('class' => 'control-label')) }}
         <div class="controls">
            {{ Form::checkbox('activated') }}
        </div>
    </div>
    <div class="control-group">
        {{ Form::label('permissions[]', 'Super User?:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::checkbox('permissions[]', 'superuser', isset($user) ? $user->isSuperUser() : false ) }}
        </div>
    </div>

    @if(isset($user))
        <div class="control-group">
            {{ Form::label('groups', 'Groups:', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::checkboxes('groups', isset($user) ? $user->getGroups()->lists('id') : array(), Group::all()->lists('name', 'id')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('permissions', 'Permissions:', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::checkboxes('permissions', isset($user) ? array_keys($user->permissions) : array(), Permission::all()->lists('name', 'slug')) }}
            </div>
        </div>
    @endif

    {{ Form::buttons('admin.users.index')}}

{{ Form::close() }}

@include('admin::global.errors', array('errors' => $errors))